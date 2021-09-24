<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Profile\Transformation\Exception;

use Aggrego\Component\BoardComponent\Application\Exception\Runtime;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;

class TransformationProfileNotFound extends Runtime
{
    public static function notFound(Name $name): self
    {
        return new self('Transformation Profile not found for ID: ' . $name);
    }
}
