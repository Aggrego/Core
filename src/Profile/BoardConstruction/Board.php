<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Shared\ValueObject\Key;

interface Board
{
    public function getKey(): Key;

    public function getProfile(): Profile;

    public function getStep(): Step;
}