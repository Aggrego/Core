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
use Aggrego\Application\Message\MessageFactory;
use Aggrego\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\MessageClient\Client;

class UseCase
{
    private const BUILDING_PROFILE_NOT_FOUND_CODE = 014040;

    private const BUILDING_PROFILE_NOT_FOUND_MESSAGE = 'Building profile not found';

    private const UNPROCESSABLE_KEY_CHANGE_CODE = 014000;

    private const UNPROCESSABLE_KEY_CHANGE_MESSAGE = 'Unprocessable Key Change';

    private const UNPROCESSABLE_PROTOTYPE_CODE = 014001;

    private const UNPROCESSABLE_PROTOTYPE_MESSAGE = 'Unprocessable prototype';

    private const BOARD_EXISTS_CODE = 014002;

    private const BOARD_EXISTS_MESSAGE = 'Board exists with "%s" id';

    private const BOARD_CREATED_CODE = 012000;

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
            $this->messageClient->consume(
                $this->messageFactory->notFound(
                    $command,
                    self::BUILDING_PROFILE_NOT_FOUND_CODE,
                    self::BUILDING_PROFILE_NOT_FOUND_MESSAGE
                )
            );

            return;
        }
        try {
            $prototype = $profile->buildBoard($command->getKey());
        } catch (UnprocessableKeyChange $e) {
            $this->messageClient->consume(
                $this->messageFactory->failed(
                    $command,
                    self::UNPROCESSABLE_KEY_CHANGE_CODE,
                    self::UNPROCESSABLE_KEY_CHANGE_MESSAGE
                )
            );
            return;
        }

        try {
            $board = $this->boardBuilder->build($this->idFactory, $prototype);
        } catch (UnprocessablePrototype $e) {
            $this->messageClient->consume(
                $this->messageFactory->failed(
                    $command,
                    self::UNPROCESSABLE_PROTOTYPE_CODE,
                    self::UNPROCESSABLE_PROTOTYPE_MESSAGE
                )
            );
            return;
        }
        try {
            $this->boardRepository->addBoard($board);
        } catch (BoardExist $e) {
            $this->messageClient->consume(
                $this->messageFactory->failed(
                    $command,
                    self::BOARD_EXISTS_CODE,
                    sprintf(self::BOARD_EXISTS_MESSAGE, $board->getId()->getValue())
                )
            );
            return;
        }

        $this->messageClient->consume($this->messageFactory->success($command, self::BOARD_CREATED_CODE));
    }
}
