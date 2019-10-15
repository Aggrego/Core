<?php

declare(strict_types = 1);

namespace Tests\Profile\Transformation;

use Aggrego\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Domain\Profile\Name;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;

class TestTransformationProfileRepository implements TransformationProfileRepository
{
    /**
     * @throws TransformationProfileNotFound
     */
    public function getByName(Name $name): TransformationProfile
    {
        if ((string)$name !== TestTransformationProfile::NAME) {
            throw new TransformationProfileNotFound();
        }
        return new TestTransformationProfile();
    }
}
