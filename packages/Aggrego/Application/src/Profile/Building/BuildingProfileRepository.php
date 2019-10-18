<?php

declare(strict_types=1);

namespace Aggrego\Application\Profile\Building;

use Aggrego\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Domain\Profile\Building\BuildingProfile;
use Aggrego\Domain\Profile\Name;

interface BuildingProfileRepository
{
    /**
     * @throws BuildingProfileNotFound
     */
    public function getByName(Name $name): BuildingProfile;
}
