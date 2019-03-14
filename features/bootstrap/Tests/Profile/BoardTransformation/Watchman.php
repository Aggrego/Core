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

namespace Tests\Profile\BoardTransformation;

use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Prototype\Board as DataBoardPrototype;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\Profile\BoardTransformation\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Tests\Profile\BaseTestWatchman;

class Watchman extends BaseTestWatchman implements DomainWatchman
{
    public function passTransformation(Profile $profile): Transformation
    {
        return new class extends BaseTestWatchman implements Transformation
        {
            public function transform(Key $key, Board $board): BoardPrototype
            {
                $keyData = $key->getValue();
                Assertion::keyExists($keyData, 'value');

                return new DataBoardPrototype($key, $board->getProfile(), new Data($keyData['value']));
            }
        };
    }
}
