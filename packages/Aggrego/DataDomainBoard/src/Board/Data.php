<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\DataDomainBoard\Board;

use Exception;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class Data extends StringValueObject
{
    /**
     * @throws Exception if value is invalid
     */
    protected function guard(string $value): void
    {
        return;
    }
}
