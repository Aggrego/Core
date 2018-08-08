<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\BoardTransformation;

use Aggrego\Domain\Profile\Profile;

interface Watchman
{
    public function isSupported(Profile $profile): bool;

    public function passTransformation(Profile $profile): Transformation;
}
