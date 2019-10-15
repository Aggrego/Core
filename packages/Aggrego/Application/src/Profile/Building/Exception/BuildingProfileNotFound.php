<?php

declare(strict_types = 1);

namespace Aggrego\Application\Profile\Building\Exception;

use Aggrego\Application\Exception\Runtime;
use Aggrego\Domain\Profile\Name;

class BuildingProfileNotFound extends Runtime
{
    public static function notFound(Name $name): self
    {
        return new self('Building Profile not found for ID: ' . $name);
    }
}
