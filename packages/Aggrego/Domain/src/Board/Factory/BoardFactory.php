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

namespace Aggrego\Domain\Board\Factory;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Domain\Board\Id\IdFactory;
use Aggrego\Domain\Board\Prototype\Prototype;

interface BoardFactory
{
    /**
     * @throws UnprocessablePrototype
     */
    public function build(IdFactory $factory, Prototype $prototype): Board;
}
