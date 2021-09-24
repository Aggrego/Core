<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Profile\Building;

use Aggrego\Component\BoardComponent\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\BuildingProfile;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;

interface BuildingProfileRepository
{
    /**
     * @throws BuildingProfileNotFound
     */
    public function getByName(Name $name): BuildingProfile;
}
