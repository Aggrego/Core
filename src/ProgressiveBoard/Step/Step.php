<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Step;

interface Step
{
    public function getState(): State;

    public function readyToTransformation(): bool;
}
