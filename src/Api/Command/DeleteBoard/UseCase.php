<?php

namespace Aggrego\Domain\Api\Command\DeleteBoard;

use Aggrego\Domain\Model\ProgressBoard\Repository;
use Aggrego\Domain\ValueObject\Uuid;

class UseCase
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Command $command): void
    {
        $uuid = new Uuid($command->getBoardUuid());
        $board = $this->repository->getBoardByUuid($uuid);
        $board->markAsDeleted();
    }
}
