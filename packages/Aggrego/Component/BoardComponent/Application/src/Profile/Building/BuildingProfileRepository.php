<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
