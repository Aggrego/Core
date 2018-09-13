<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Api\Command\CreateBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Board\Factory;
use Aggrego\Domain\Board\Repository;

class UseCase
{
    /** @var Repository */
    private $repository;

    /** @var Factory */
    private $factory;

    public function __construct(
        Repository $repository,
        Factory $factory
    )
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        $this->repository->addBoard(
            $this->factory->newBoard($command->getKey(), $command->getProfile())
        );
    }
}
