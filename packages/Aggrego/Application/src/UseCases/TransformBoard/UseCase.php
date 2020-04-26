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
use Aggrego\Application\Message\MessageFactory;
use Aggrego\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\MessageClient\Client;

class UseCase
{
    private const BUILDING_PROFILE_NOT_FOUND_CODE = 024040;

    private const BUILDING_PROFILE_NOT_FOUND_MESSAGE = 'Building profile not found';

    private const UNPROCESSABLE_BOARD_CODE = 024000;

    private const UNPROCESSABLE_BOARD_MESSAGE = 'Unprocessable board %s id';

    private const UNPROCESSABLE_KEY_CHANGE_CODE = 024001;

    private const UNPROCESSABLE_KEY_CHANGE_MESSAGE = 'Unprocessable Key Change';

    private const UNPROCESSABLE_PROTOTYPE_CODE = 024002;

    private const UNPROCESSABLE_PROTOTYPE_MESSAGE = 'Unprocessable prototype';

    private const BOARD_EXISTS_CODE = 024003;

    private const BOARD_EXISTS_MESSAGE = 'Board exists with "%s" id';

    private const BOARD_CREATED_CODE = 022000;

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
            $transformation = $this->transformationProfileRepository->getByName($board->getProfileName());
        } catch (TransformationProfileNotFound $e) {
            $this->messageClient->consume($this->messageFactory->profileNotFound($command));
            return;
        }

        try {
            $prototype = $board->transform($command->getKey(), $transformation);
        } catch (UnprocessableBoard $e) {
            $this->messageClient->consume(
                $this->messageFactory->failed(
                    $command,
                    self::UNPROCESSABLE_BOARD_CODE,
                    sprintf(self::UNPROCESSABLE_BOARD_MESSAGE, $board->getId()->getValue())
                )
            );
            return;
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
            $board = $this->boardFactory->build($this->idFactory, $prototype);
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
