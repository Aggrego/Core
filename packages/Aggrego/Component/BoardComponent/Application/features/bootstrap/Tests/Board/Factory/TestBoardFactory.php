<?php

declare(strict_types=1);

namespace Tests\Board\Factory;

use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\BoardFactory;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Board\Id\IdFactory;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Tests\Board\Board as TestBoard;

class TestBoardFactory implements BoardFactory
{
    /**
     * @throws UnprocessablePrototype
     */
    public function build(IdFactory $factory, Prototype $prototype): Board
    {
        return new TestBoard($factory->generateNew($prototype), $prototype->getProfileName());
    }
}
