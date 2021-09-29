<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\TransformBoard;

use Aggrego\Component\BoardComponent\Application\Board\BoardRepository;
use Aggrego\Component\BoardComponent\Application\Board\Exception\BoardExist;
use Aggrego\Component\BoardComponent\Application\Board\Exception\BoardNotFound;
use Aggrego\Component\BoardComponent\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Component\BoardComponent\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\TransformBoardCommand;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\BoardFactory;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Board\Id\IdFactory;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\Contract\MessageClient\Client;

class TransformBoardUseCase
{
    public function __construct(
        private BoardRepository $boardRepository,
        private TransformationProfileRepository $transformationProfileRepository,
        private BoardFactory $boardFactory,
        private IdFactory $idFactory,
        private Client $messageClient,
        private MessageFactory $messageFactory
    ) {
    }

    public function handle(TransformBoardCommand $command): void
    {
        try {
            $board = $this->boardRepository->getBoardByUuid($command->getBoardId());
        } catch (BoardNotFound $e) {
            $this->messageClient->consume($this->messageFactory->boardNotFound($command));
            return;
        }
        try {
            $transformation = $this->transformationProfileRepository->getByName($board->getProfileName());
        } catch (TransformationProfileNotFound $e) {
            $this->messageClient->consume($this->messageFactory->profileNotFound($command));
            return;
        }

        try {
            $prototype = $board->transform($command->getKey(), $transformation);
        } catch (UnprocessableBoard $e) {
            $this->messageClient->consume($this->messageFactory->unprocessableBoard($command));
            return;
        } catch (UnprocessableKeyChange $e) {
            $this->messageClient->consume($this->messageFactory->unprocessableKeyChange($command));
            return;
        }
        try {
            $board = $this->boardFactory->build($this->idFactory, $prototype);
        } catch (UnprocessablePrototype $e) {
            $this->messageClient->consume($this->messageFactory->unprocessablePrototype($command));
        }

        try {
            $this->boardRepository->addBoard($board);
        } catch (BoardExist $e) {
            $this->messageClient->consume($this->messageFactory->boardExist($command));
        }
        $this->messageClient->consume($this->messageFactory->boardCreated($board, $command));
    }
}
