<?php

declare(strict_types=1);

namespace Tests\Profile\Building;

use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Exception\InvalidName;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Metadata;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Name as PrototypeName;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\BuildingProfile;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;
use Tests\BoardPrototype\TestPrototype;

class TestBuildingProfile implements BuildingProfile
{
    public const NAME = 'test_profile';

    public const VERSION = '1.0';

    public function getName(): Name
    {
        return Name::createFromParts(self::NAME, self::VERSION);
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
        return new TestPrototype(
            new PrototypeName('test'),
            $this->getName(),
            new Metadata(['key' => $changeValue['key']]),
            null
        );
    }
}
