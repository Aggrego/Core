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

use DateTimeImmutable;
use TimiTao\ValueObject\Utils\TimestampValueObject;

class CreatedAt extends TimestampValueObject
{
    public function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        parent::__construct(self::class, $dateTimeImmutable);
    }
}
