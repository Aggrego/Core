<?php

declare(strict_types = 1);

namespace Tests\Board\Factory;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\BoardPrototype\Prototype;

class TestBoardFactory implements BoardFactory
{
    /**
     * @throws UnprocessablePrototype
     */
    public function build(IdFactory $factory, Prototype $prototype): Board
    {
        // TODO: Implement build() method.
    }
}
