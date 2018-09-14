<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Profile\Profile;
use Aggrego\EventStore\Aggregate;

interface Board extends Aggregate
{
    public function getProfile(): Profile;
}
