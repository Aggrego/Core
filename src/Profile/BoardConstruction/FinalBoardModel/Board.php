<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\FinalBoardModel;

use Aggrego\Domain\Profile\BoardConstruction\Board as BoardInterface;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;

class Board implements BoardInterface
{
    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    public function __construct(Key $key, Profile $profile, Data $data)
    {
        $this->key = $key;
        $this->profile = $profile;
        $this->data = $data;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getData(): Data
    {
        return $this->data;
    }

    public function getStep(): Step
    {
        return new FinalStep($this->data);
    }
}
