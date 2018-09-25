<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\Domain\Profile;

use Assert\Assertion;

class Profile
{
    private const SEPARATOR = ':';

    /** @var string */
    private $name;

    /** @var string */
    private $version;

    private function __construct(string $name, string $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    public static function createFrom(string $name, string $version): self
    {
        Assertion::regex($name, sprintf('/^[^%s]*$/', self::SEPARATOR));
        Assertion::regex($version, sprintf('/^[^%s]*$/', self::SEPARATOR));

        return new self($name, $version);
    }

    public function equal(self $profile): bool
    {
        return $this->name === $profile->name
            && $this->version === $profile->version;
    }

    public function __toString(): string
    {
        return $this->name . self::SEPARATOR . $this->version;
    }
}
