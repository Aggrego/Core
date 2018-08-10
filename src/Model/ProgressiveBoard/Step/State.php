<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Step;

use Aggrego\Domain\Shared\ValueObject\AbstractStringValueObject;

final class State extends AbstractStringValueObject
{
    public const INITIAL = 'initial';
    public const FINAL = 'final';

    public function __construct(string $value)
    {
        parent::__construct($value, self::class);
    }

    public static function createInitial(): self
    {
        return new self(self::INITIAL);
    }

    public function isFinal(): bool
    {
        return $this->getValue() === self::FINAL;
    }
}
