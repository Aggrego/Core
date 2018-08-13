<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\CreateBoard;

use Aggrego\Domain\Profile\BoardConstruction\Exception\BuilderNotFoundException;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Profile\BoardConstruction\Factory;
use Aggrego\Domain\Api\Domain\Command\CreateBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\ProgressiveBoard\Board;
use Aggrego\Domain\ProgressiveBoard\Exception\BoardExistException;
use Aggrego\Domain\ProgressiveBoard\Repository;

class UseCase
{
    /** @var Repository */
    private $boardRepository;

    /** @var Factory */
    private $profileBoardFactory;

    public function __construct(
        Repository $boardRepository,
        Factory $profileBoardFactory
    )
    {
        $this->boardRepository = $boardRepository;
        $this->profileBoardFactory = $profileBoardFactory;
    }

    /**
     * @param Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        $key = $command->getKey();
        $profile = $command->getProfile();

        try {
            $this->boardRepository->addBoard(
                Board::factory(
                    $key,
                    $this->profileBoardFactory->factory($profile)
                )
            );
        } catch (BuilderNotFoundException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        } catch (UnableToBuildBoardException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        } catch (BoardExistException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
