<?php

declare(strict_types = 1);

namespace FeatureContext\Functional;

use Behat\Behat\Context\Context;

class ProfileFeatureContext implements Context
{
    public const DEFAULT_PROFILE = 'test_true';
    public const DEFAULT_VERSION = '1.0';
}
