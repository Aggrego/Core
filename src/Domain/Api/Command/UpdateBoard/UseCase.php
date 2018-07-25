<?php

namespace TimiTao\Construo\Domain\Api\Command\UpdateBoard;

use TimiTao\Construo\Domain\Model\ProgressBoard\Repository;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

class UseCase
{
    /** @var Repository */
    private $boardRepository;

    public function __construct(Repository $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function handle(Command $command): void
    {
        $board = $this->boardRepository->getBoardByUuid(
            new Uuid($command->getBoardUuid())
        );

        $board->updateShard(
            new Uuid($command->getShardUuid()),
            new Source(
                new Name($command->getSourceName()),
                new Version($command->getVersionName())
            ),
            new Data($command->getData())
        );
    }
}
