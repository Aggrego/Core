<?php

declare(strict_types=1);

namespace Aggrego\Application\Profile\Transformation;

use Aggrego\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Domain\Profile\Name;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;

interface TransformationProfileRepository
{
    /**
     * @throws TransformationProfileNotFound
     */
    public function getByName(Name $name): TransformationProfile;
}
