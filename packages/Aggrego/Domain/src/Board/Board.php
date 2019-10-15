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

namespace Aggrego\Domain\Board;

use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;

interface Board
{
    public function getId(): Id;

    public function getName(): Name;

    public function getProfileName(): ProfileName;

    /**
     * @throws UnprocessableKeyChange
     * @throws UnprocessableBoard
     */
    public function transform(KeyChange $key, TransformationProfile $transformation): Prototype;
}
