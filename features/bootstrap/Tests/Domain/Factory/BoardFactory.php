<?php

declare(strict_types = 1);

namespace Tests\Domain\Factory;

use TimiTao\Construo\Domain\Factory\BoardFactory as DomainBoardFactory;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board;

class BoardFactory implements DomainBoardFactory
{
    public function factory(Key $key, Profile $profile): Board
    {
        $board = new Board($key, $profile);
        $board->addShard($key, new Source($profile->getName(), $profile->getVersion()));
        return $board;
    }
}
