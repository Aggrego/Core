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

namespace Aggrego\Domain\BoardPrototype;

use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Profile\Name as ProfileName;

interface Prototype
{
    public function getName(): Name;

    public function getProfileName(): ProfileName;

    public function getMetadata(): Metadata;

    public function hasParentId(): bool;

    public function getParentId(): Id;
}
