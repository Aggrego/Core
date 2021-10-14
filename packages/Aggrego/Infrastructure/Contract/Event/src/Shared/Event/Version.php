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
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class Version extends StringValueObject implements EventVersion
{
    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(string $value)
    {
        Assertion::regex($value, '~^([0-9]+\.{0,1})+$~');
        parent::__construct($value);
    }

    public static function normalize(string $value): self
    {
        $normalized = (new VersionParser())->normalize($value);
        return new self($normalized);
    }
}
