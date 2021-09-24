<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Board\Id;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;
use Assert\Assertion;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class Uuid extends StringValueObject implements Id
{
    /**
     * @throws Exception if value is invalid
     * @throws \Assert\AssertionFailedException
     */
    protected function guard(string $value): void
    {
        Assertion::regex(
            $value,
            '/^[0-9A-F]{8}-[0-9A-F]{4}-[1-5][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
            'Incorrect UUID format: ' . $value
        );
    }
}
