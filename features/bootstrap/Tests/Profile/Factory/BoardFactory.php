<?php

declare(strict_types = 1);

namespace Tests\Profile\Factory;

use TimiTao\Construo\Domain\Factory\BoardFactory as DomainBoardFactory;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Version;

class BoardFactory implements DomainBoardFactory
{
    public function factory(Key $key, Profile $profile): Board
    {
        $board =  new Board($key, $profile);
        $board->addShard(new Key(['prefix' => 'Mr']), new Source(new Name('fake.surname'), new Version('1.0')));
        $board->addShard(new Key(['prefix' => 'Mrs']), new Source(new Name('fake.surname'), new Version('1.0')));

        return $board;
    }
}
