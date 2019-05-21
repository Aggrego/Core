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

namespace Aggrego\EventConsumer\Event;

use Assert\Assertion;

class Domain
{
    private const SEPARATOR = ':';

    /** @var Name  */
    private $name;

    /** @var Uuid  */
    private $uuid;

    public function __construct(Name $name, Uuid $uuid)
    {
        $this->name = $name;
        $this->uuid = $uuid;
    }

    /**
     * @param  string $string
     * @return Domain
     * @throws \Assert\AssertionFailedException
     */
    public static function fromString(string $string): Domain
    {
        Assertion::notEmpty($string);
        list($domainName, $uuid) = explode(self::SEPARATOR, $string);

        return self::build($domainName, $uuid);
    }

    /**
     * @param  string $domainName
     * @param  string $uuid
     * @return Domain
     * @throws \Assert\AssertionFailedException
     */
    public static function build(string $domainName, string $uuid): self
    {
        return new self(new Name($domainName), new Uuid($uuid));
    }

    public function getValue(): string
    {
        return sprintf('%s:%s', $this->name->getValue(), $this->uuid->getValue());
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
}
