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

namespace Aggrego\DataDomainBoard\Board\Prototype;

use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Metadata as DomainMetadata;
use Aggrego\Domain\Board\Prototype\Board as BoardInterface;
use Aggrego\Domain\Profile\Profile;

class Board implements BoardInterface
{
    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    public function __construct(Key $key, Profile $profile, Data $data)
    {
        $this->key = $key;
        $this->profile = $profile;
        $this->data = $data;
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
        return new Metadata($this->data);
    }
}
