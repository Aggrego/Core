<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Shared\Profile;

use Aggrego\Component\BoardComponent\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Component\BoardComponent\Application\Profile\Building\Exception\BuildingProfileNotFound;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\BuildingProfile;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;

class SingleBuildingProfileRepository implements BuildingProfileRepository
{
    public function __construct(
        private BuildingProfile $buildingProfile
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getByName(Name $name): BuildingProfile
    {
        if ($this->buildingProfile->getName()->equal($name)) {
            return $this->buildingProfile;
        }

        throw BuildingProfileNotFound::notFound($name);
    }
}
