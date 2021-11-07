<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Domain\BoardPrototype;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Exception\MissingParentId;
use Aggrego\Component\BoardComponent\Domain\Profile\Name as ProfileName;

interface Prototype
{
    public function getName(): Name;

    public function getProfileName(): ProfileName;

    public function getMetadata(): Metadata;

    public function hasParentId(): bool;

    /**
     * @throws MissingParentId
     */
    public function getParentId(): Id;
}
