<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Message\Factory;

use Aggrego\Infrastructure\Message\Sender;

interface SenderFactory
{
    public function factor(): Sender;
}