<?php

declare(strict_types = 1);

namespace Aggrego\Application\Profile;

use Aggrego\Application\Profile\Exception\BuildingProfileNotFound;
use Aggrego\Domain\Profile\Building\BuildingProfile;
use Aggrego\Domain\Profile\Name;

interface BuildingProfileRepository
{
    /**
     * @throws BuildingProfileNotFound
     */
    public function getByName(Name $name): BuildingProfile;
}
