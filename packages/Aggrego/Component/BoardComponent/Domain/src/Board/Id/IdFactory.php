<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Board\Id;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;

interface IdFactory
{
    /**
     * @throws UnprocessablePrototype
     */
    public function generateNew(Prototype $prototype): Id;
}
