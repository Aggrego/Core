<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
