<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\CreateBoard;

use Aggrego\Component\BoardComponent\Application\Board\BoardRepository;
use Aggrego\Component\BoardComponent\Application\Board\Exception\BoardExist;
use Aggrego\Component\BoardComponent\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Component\BoardComponent\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\CreateBoardCommand;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\BoardFactory;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Board\Id\IdFactory;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\MessageClient\Client;

class CreateBoardUseCase
{
    public function __construct(
        private BoardRepository $boardRepository,
        private BuildingProfileRepository $buildingProfileRepository,
        private BoardFactory $boardBuilder,
        private IdFactory $idFactory,
        private Client $messageClient,
        private MessageFactory $messageFactory
    ) {
    }

    public function handle(CreateBoardCommand $command): void
    {
        try {
            $profile = $this->buildingProfileRepository->getByName($command->getProfile());
        } catch (BuildingProfileNotFound $e) {
            $this->messageClient->consume($this->messageFactory->profileNotFound($command));
            return;
        }
        try {
            $prototype = $profile->buildBoard($command->getKey());
        } catch (UnprocessableKeyChange $e) {
            $this->messageClient->consume($this->messageFactory->unprocessableKeyChange($command));
            return;
        }

        try {
            $board = $this->boardBuilder->build($this->idFactory, $prototype);
        } catch (UnprocessablePrototype $e) {
            $this->messageClient->consume($this->messageFactory->unprocessablePrototype($command));
            return;
        }
        try {
            $this->boardRepository->addBoard($board);
        } catch (BoardExist $e) {
            $this->messageClient->consume($this->messageFactory->boardExist($command));
            return;
        }

        $this->messageClient->consume($this->messageFactory->boardCreated($board, $command));
    }
}
