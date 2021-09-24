<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\Profile\Transformation;

use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Profile;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;

interface TransformationProfile extends Profile
{
    /**
     * @throws UnprocessableKeyChange
     * @throws UnprocessableBoard
     */
    public function transform(KeyChange $change, Board $board): Prototype;
}
