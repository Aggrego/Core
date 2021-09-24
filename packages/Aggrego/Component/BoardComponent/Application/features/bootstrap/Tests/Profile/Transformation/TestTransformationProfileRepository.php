<?php

declare(strict_types=1);

namespace Tests\Profile\Transformation;

use Aggrego\Application\Profile\Transformation\Exception\TransformationProfileNotFound;
use Aggrego\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\TransformationProfile;

class TestTransformationProfileRepository implements TransformationProfileRepository
{
    /**
     * @throws TransformationProfileNotFound
     */
    public function getByName(Name $name): TransformationProfile
    {
        if ((string) $name !== TestTransformationProfile::NAME) {
            throw new TransformationProfileNotFound('Error: ' . __FILE__);
        }
        return new TestTransformationProfile();
    }
}
