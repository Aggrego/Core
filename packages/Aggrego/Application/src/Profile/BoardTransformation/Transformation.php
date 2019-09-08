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

namespace Aggrego\Application\Profile\BoardTransformation;

use Aggrego\Application\Board\Board;
use Aggrego\Application\Board\Key;
use Aggrego\Application\Board\Prototype\Board as BoardPrototype;
use Aggrego\Application\Profile\BoardTransformation\Exception\UnprocessableBoardException;

interface Transformation
{
    /**
     * @param  Key   $key
     * @param  Board $board
     * @return BoardPrototype
     * @throws UnprocessableBoardException
     */
    public function transform(Key $key, Board $board): BoardPrototype;
}
