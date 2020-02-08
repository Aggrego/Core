<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Domain\Profile;

use Aggrego\Domain\Profile\Exception\InvalidName;
use Assert\Assertion;
use Assert\AssertionFailedException;

final class Name
{
    private const SEPARATOR = ':';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    private function __construct(string $name, string $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    public function __toString(): string
    {
        return $this->name . self::SEPARATOR . $this->version;
    }

    /**
     * @throws InvalidName
     */
    public static function createFromParts(string $name, string $version): self
    {
        try {
            Assertion::regex($name, sprintf('/^[^%s]*$/', self::SEPARATOR));
        } catch (AssertionFailedException $e) {
            throw InvalidName::name($name);
        }
        try {
            Assertion::regex($version, sprintf('/^[^%s]*$/', self::SEPARATOR));
        } catch (AssertionFailedException $e) {
            throw InvalidName::version($version);
        }

        return new self($name, $version);
    }

    /**
     * @throws AssertionFailedException
     * @throws InvalidName
     */
    public static function createFromName(string $fullName): self
    {
        $parts = explode(self::SEPARATOR, $fullName);
        Assertion::count($parts, 2);

        $name = $parts[0];
        $version = $parts[1];

        try {
            Assertion::regex($name, sprintf('/^[^%s]*$/', self::SEPARATOR));
        } catch (AssertionFailedException $e) {
            throw InvalidName::name($version);
        }
        try {
            Assertion::regex($version, sprintf('/^[^%s]*$/', self::SEPARATOR));
        } catch (AssertionFailedException $e) {
            throw InvalidName::version($version);
        }

        return new self($name, $version);
    }

    public function equal(self $profile): bool
    {
        return $this->name === $profile->name
            && $this->version === $profile->version;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
