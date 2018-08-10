<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Step;

interface Step
{
    public function getState(): State;
}
