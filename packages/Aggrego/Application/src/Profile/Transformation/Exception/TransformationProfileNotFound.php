<?php

declare(strict_types = 1);

namespace Aggrego\Application\Profile\Transformation\Exception;

use Aggrego\Application\Exception\Runtime;
use Aggrego\Domain\Profile\Name;

class TransformationProfileNotFound extends Runtime
{
    public static function notFound(Name $name): self
    {
        return new self('Transformation Profile not found for ID: ' . $name);
    }
}
