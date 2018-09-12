<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Step\Steps;

use Aggrego\Domain\ProgressiveBoard\Step\State;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Shared\ValueObject\Data;

final class FinalStep implements Step
{
    /** @var Data */
    private $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function getState(): State
    {
        return new State(State::FINAL);
    }

    public function getData(): Data
    {
        return $this->data;
    }

    public function readyToTransformation(): bool
    {
        return false;
    }
}
