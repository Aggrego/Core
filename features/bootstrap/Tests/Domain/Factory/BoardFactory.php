<?php

declare(strict_types = 1);

namespace Tests\Domain\Factory;

use TimiTao\Construo\Domain\Factory\BoardFactory as DomainBoardFactory;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;

class BoardFactory implements DomainBoardFactory
{
    public function factory(Key $key, Profile $profile): Board
    {
        return new Board(
            $key,
            $profile,
            new Shards(
                [
                    new Shard(
                        new Source(
                            $profile->getName(),
                            $profile->getVersion()
                        )
                    )
                ]
            )
        );
    }
}
