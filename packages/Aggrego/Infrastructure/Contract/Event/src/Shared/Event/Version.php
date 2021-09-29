<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\Version as EventVersion;
use Assert\Assertion;
use Composer\Semver\VersionParser;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class Version extends StringValueObject implements EventVersion
{
    public static function normalize(string $value): self
    {
        $normalized = (new VersionParser())->normalize($value);
        return new self($normalized);
    }

    protected function guard(string $value): void
    {
        Assertion::regex($value, '~^([0-9]+\.{0,1})+$~');
    }
}
