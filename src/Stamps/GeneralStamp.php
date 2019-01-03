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

use TimiTao\ValueObject\Utils\StringValueObject;

class GeneralStamp extends StringValueObject
{
    /** @var string */
    private $name;

    public function __construct(string $name, string $value)
    {
        parent::__construct(self::class, $value);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
