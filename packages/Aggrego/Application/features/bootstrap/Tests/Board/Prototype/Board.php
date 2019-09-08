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

namespace Tests\Board\Prototype;

use Aggrego\Application\Board\Key;
use Aggrego\Application\Board\Prototype\Metadata as DomainMetadata;
use Aggrego\Application\Board\Prototype\Board as BoardPrototype;
use Aggrego\Application\Profile\Profile;

class Board implements BoardPrototype
{
    /**
     * @var Key
     */
    private $key;

    /**
     * @var Profile
     */
    private $profile;

    /**
     * @var Metadata
     */
    private $metadata;

    public function __construct(Key $key, Profile $profile)
    {
        $this->key = $key;
        $this->profile = $profile;
        $this->metadata = new Metadata();
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getMetadata(): DomainMetadata
    {
        return $this->metadata;
    }
}
