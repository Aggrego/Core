<?php

declare(strict_types=1);

namespace Aggrego\DataDomainBoard\Board\Factory;

use Aggrego\DataDomainBoard\Board\Board as DataDomainBoard;
use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Factory\BoardFactory as DomainBoardFactory;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Board\Name;
use Aggrego\Domain\BoardPrototype\Prototype;

class BoardFactory implements DomainBoardFactory
{
    public function build(IdFactory $factory, Prototype $prototype): Board
    {
        return new DataDomainBoard(
            $factory->generateNew($prototype),
            new Name($prototype->getName()->getValue()),
            $prototype->getProfileName(),
            $prototype->hasParentId() ? $prototype->getParentId() : null,
            new Data((string) json_encode($prototype->getMetadata()))
        );
    }
}
