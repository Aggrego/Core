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

namespace Aggrego\Domain\Board\Prototype;

final class Metadata
{
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function getList(): array
    {
        return $this->list;
    }
}
