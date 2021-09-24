<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Profile\Building;

use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Profile;

interface BuildingProfile extends Profile
{
    /**
     * @throws UnprocessableKeyChange
     */
    public function buildBoard(KeyChange $change): Prototype;
}
