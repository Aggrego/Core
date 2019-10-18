<?php

declare(strict_types=1);

namespace Aggrego\Application\Board\Id;

use Aggrego\Domain\Board\Id\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\BoardPrototype\Prototype;
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
                    serialize($prototype->getMetadata()->getData()),
                    $prototype->getProfileName(),
                    $parentId
                )
            )->toString()
        );
    }
}
