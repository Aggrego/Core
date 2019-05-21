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

namespace Aggrego\Domain\Board;

use Assert\Assertion;
use TimiTao\ValueObject\Utils\StringValueObject;

class Uuid extends StringValueObject
{
    public function __construct(string $value)
    {
        Assertion::regex(
            $value,
            '/^[0-9A-F]{8}-[0-9A-F]{4}-[1-5][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
            'Incorrect UUID format: ' . $value
        );
        parent::__construct(self::class, $value);
    }
}
