<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Shared\Board\Id;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;
use Aggrego\Component\BoardComponent\Domain\Board\Id\IdFactory;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidIdFactory implements IdFactory
{
    /**
     * @throws UnprocessablePrototype
     */
    public function generateNew(Prototype $prototype): Id
    {
        $parentId = null;
        if ($prototype->hasParentId()) {
            $parentId = $prototype->getParentId()->getValue();
        }

        return new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                sprintf(
                    '%s-%s-%s',
                    serialize($prototype->getMetadata()->getValue()),
                    $prototype->getProfileName(),
                    $parentId
                )
            )->toString()
        );
    }
}
