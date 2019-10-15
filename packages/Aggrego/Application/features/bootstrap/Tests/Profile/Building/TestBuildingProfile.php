<?php

declare(strict_types = 1);

namespace Tests\Profile\Building;

use Aggrego\Domain\BoardPrototype\Metadata;
use Aggrego\Domain\BoardPrototype\Name as PrototypeName;
use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\BoardPrototype\Exception\InvalidName;
use Aggrego\Domain\Profile\Building\BuildingProfile;
use Aggrego\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name;
use Tests\BoardPrototype\TestPrototype;

class TestBuildingProfile implements BuildingProfile
{
    public const NAME = 'test_profile:1.0';

    public function getName(): Name
    {
        return Name::createFromName(self::NAME);
    }

    /**
     * @throws UnprocessableKeyChange
     * @throws InvalidName
     */
    public function buildBoard(KeyChange $change): Prototype
    {
        $changeValue = $change->getValue();
        if (!isset($changeValue['key'])) {
            throw new UnprocessableKeyChange();
        }
        $prototype = new TestPrototype(
            new PrototypeName('test'),
            $this->getName(),
            new Metadata(['key' => $changeValue['key']]),
            null
        );

        return $prototype;
    }
}
