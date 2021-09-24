<?php

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
