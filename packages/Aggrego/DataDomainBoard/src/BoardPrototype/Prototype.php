<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\DataDomainBoard\BoardPrototype;

use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\BoardPrototype\Metadata;
use Aggrego\Domain\BoardPrototype\Name;
use Aggrego\Domain\BoardPrototype\Prototype as BoardPrototype;
use Aggrego\Domain\Profile\Name as ProfileName;

class Prototype implements BoardPrototype
{
    private $name;

    private $profileName;

    private $metadata;

    private $parentId;

    public function __construct(
        Name $name,
        ProfileName $profileName,
        Metadata $metadata,
        ?Id $parentId
    ) {
        $this->name = $name;
        $this->profileName = $profileName;
        $this->metadata = $metadata;
        $this->parentId = $parentId;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getProfileName(): ProfileName
    {
        return $this->profileName;
    }

    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    public function hasParentId(): bool
    {
        return $this->parentId !== null;
    }

    public function getParentId(): Id
    {
        return $this->parentId;
    }
}
