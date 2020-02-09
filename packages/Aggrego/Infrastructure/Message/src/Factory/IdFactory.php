<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Message\Factory;

use Aggrego\Infrastructure\Message\Id;

interface IdFactory
{
    public function factory(): Id;
}