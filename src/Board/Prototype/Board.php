<?php

declare(strict_types = 1);

namespace Aggrego\DataBoard\Board\Prototype;

use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Metadata as DomainMetadata;
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

    public function getData(): Data
    {
        return $this->data;
    }

    public function getMetadata(): DomainMetadata
    {
        return new Metadata($this->data);
    }
}
