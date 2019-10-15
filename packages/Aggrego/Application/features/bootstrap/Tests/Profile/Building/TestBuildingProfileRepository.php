<?php

declare(strict_types = 1);

namespace Tests\Profile\Building;

use Aggrego\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Domain\Profile\Building\BuildingProfile;
use Aggrego\Domain\Profile\Name;

class TestBuildingProfileRepository implements BuildingProfileRepository
{
    /**
     * @throws BuildingProfileNotFound
     */
    public function getByName(Name $name): BuildingProfile
    {
        if ((string)$name !== TestBuildingProfile::NAME) {
            throw new BuildingProfileNotFound();
        }
        return new TestBuildingProfile();
    }
}
