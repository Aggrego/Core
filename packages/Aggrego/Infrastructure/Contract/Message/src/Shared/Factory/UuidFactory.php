<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Message\Shared\Factory;

use Aggrego\Infrastructure\Contract\Message\Factory\IdFactory;
use Aggrego\Infrastructure\Contract\Message\Id;
use Ramsey\Uuid\Uuid;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class UuidFactory implements IdFactory
{
    public function factory(): Id
    {
        return new class (Uuid::uuid4()->toString()) extends StringValueObject implements Id {
        };
    }
}
