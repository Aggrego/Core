<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\UseCases\CreateBoard;

use Aggrego\Application\Board\BoardRepository;
use Aggrego\Application\Board\Exception\BoardExist;
use Aggrego\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Application\UseCases\CreateBoard\Messages\MessageFactory;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\MessageClient\Client;

class UseCase
{
    private $boardRepository;

    private $buildingProfileRepository;

    private $boardBuilder;

    private $idFactory;

    private $messageClient;

    private $messageFactory;

    public function __construct(
        BoardRepository $boardRepository,
        BuildingProfileRepository $buildingProfileRepository,
        BoardFactory $boardBuilder,
        IdFactory $idFactory,
        Client $messageClient,
        MessageFactory $messageFactory
    ) {
        $this->boardRepository = $boardRepository;
        $this->buildingProfileRepository = $buildingProfileRepository;
        $this->boardBuilder = $boardBuilder;
        $this->idFactory = $idFactory;
        $this->messageClient = $messageClient;
        $this->messageFactory = $messageFactory;
    }

    public function handle(Command $command): void
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
