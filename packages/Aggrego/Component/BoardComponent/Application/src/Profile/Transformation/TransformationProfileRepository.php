<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Profile\Transformation;

use Aggrego\Component\BoardComponent\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\TransformationProfile;

interface TransformationProfileRepository
{
    /**
     * @throws TransformationProfileNotFound
     */
    public function getByName(Name $name): TransformationProfile;
}
