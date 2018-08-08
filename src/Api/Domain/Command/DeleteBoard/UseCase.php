<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\DeleteBoard;

use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Repository;
use Aggrego\Domain\Api\Domain\Command\DeleteBoard\Exception\InvalidCommandDataException;

class UseCase
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        try {
            $board = $this->repository->getBoardByUuid($command->getBoardUuid());
        } catch (BoardNotFoundException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }
        $board->markAsDeleted();
    }
}
