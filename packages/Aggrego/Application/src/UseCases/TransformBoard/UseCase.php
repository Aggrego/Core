<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\UseCases\TransformBoard;

use Aggrego\Application\Board\BoardRepository;
use Aggrego\Application\Board\Exception\BoardExist;
use Aggrego\Application\Board\Exception\BoardNotFound;
use Aggrego\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Application\UseCases\TransformBoard\Messages\MessageFactory;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\MessageClient\Client;

class UseCase
{
    private $boardRepository;

    private $transformationProfileRepository;

    private $boardFactory;

    private $idFactory;

    private $messageClient;

    private $messageFactory;

    public function __construct(
        BoardRepository $boardRepository,
        TransformationProfileRepository $transformationProfileRepository,
        BoardFactory $boardFactory,
        IdFactory $idFactory,
        Client $messageClient,
        MessageFactory $messageFactory
    ) {
        $this->boardRepository = $boardRepository;
        $this->transformationProfileRepository = $transformationProfileRepository;
        $this->boardFactory = $boardFactory;
        $this->idFactory = $idFactory;
        $this->messageClient = $messageClient;
        $this->messageFactory = $messageFactory;
    }

    public function handle(Command $command): void
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
