<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Profile\Building\Exception;

use Aggrego\Component\BoardComponent\Application\Exception\Runtime;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;

class BuildingProfileNotFound extends Runtime
{
    public static function notFound(Name $name): self
    {
        return new self('Building Profile not found for ID: ' . $name);
    }
}
