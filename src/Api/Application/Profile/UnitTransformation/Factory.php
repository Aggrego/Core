<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\UnitTransformation;

use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Exception\TransformationNotFoundException;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;

class Factory
{
    /** @var Watchman[] */
    private $watchmen;

    public function __construct(array $watchmen)
    {
        Assertion::allImplementsInterface($watchmen, Watchman::class);
        $this->watchmen = $watchmen;
    }

    public function factory(Profile $profile): Transformation
    {
        foreach ($this->watchmen as $watchman) {
            if ($watchman->isSupported($profile)) {
                return $watchman->passTransformation($profile);
            }
        }
        throw new TransformationNotFoundException();
    }
}
