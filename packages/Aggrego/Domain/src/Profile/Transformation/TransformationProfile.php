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

namespace Aggrego\Domain\Profile\Transformation;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Prototype\Prototype;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;

interface TransformationProfile extends Profile
{
    /**
     * @throws UnprocessableKeyChange
     * @throws UnprocessableBoard
     */
    public function transform(KeyChange $key, Board $board): Prototype;
}
