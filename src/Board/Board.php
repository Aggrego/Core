<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Profile\Profile;
use Aggrego\EventStore\Aggregate;
use Aggrego\EventStore\Uuid;

interface Board extends Aggregate
{
    public function getUuid(): Uuid;

    public function getProfile(): Profile;
}
