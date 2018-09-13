<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board\Prototype;

use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Metadata;
use Aggrego\Domain\Profile\Profile;

interface Board
{
    public function getKey(): Key;

    public function getProfile(): Profile;

    public function getMetadata(): Metadata;
}