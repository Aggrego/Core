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

namespace Aggrego\CommandConsumer\Stamps;

use Aggrego\CommandConsumer\Stamp;
use Assert\Assertion;
use Composer\Semver\VersionParser;
use TimiTao\ValueObject\Utils\StringValueObject;

class VersionStamp extends StringValueObject implements Stamp
{
    public const NAME = 'destination_version';

    public function __construct(string $value)
    {
        Assertion::regex($value, '~^([0-9]+\.{0,1})+$~');
        $normalized = (new VersionParser())->normalize($value);
        parent::__construct(self::class, $normalized);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
