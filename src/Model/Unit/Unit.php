<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\Unit;

use Aggrego\Domain\Api\Application\Event\Aggregate;
use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Transformation;
use Aggrego\Domain\Model\ProgressiveBoard\Board;
use Aggrego\Domain\Model\Unit\Events\UnitCreatedEvent;
use Aggrego\Domain\Model\Unit\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\Event\Model\TraitAggregate;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class Unit implements Aggregate
{
    use TraitAggregate;

    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    private function __construct(Uuid $uuid, Key $key, Profile $profile, Data $data)
    {
        $this->uuid = $uuid;
        $this->key = $key;
        $this->profile = $profile;
        $this->data = $data;

        $this->pushEvent(new UnitCreatedEvent($this));
    }

    public static function createFromBoard(Board $board, Transformation $transformation): self
    {
        if (!$board->isStepReadyForNextTransformation()) {
            throw new UnfinishedStepPassedForTransformationException();
        }

        return new Unit(
            $board->getUuid(),
            $board->getKey(),
            $board->getProfile(),
            $transformation->process($board->getStep())
        );
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
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
}
