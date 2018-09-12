<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction;

interface Board
{
    public function getUuid(): Uuid;

    public function getKey(): Key;

    public function getProfile(): Profile;
}