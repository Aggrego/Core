<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Step;

use TimiTao\ValueObject\Utils\StringValueObject;

final class State extends StringValueObject
{
    public const INITIAL = 'initial';
    public const FINAL = 'final';

    public function __construct(string $value)
    {
        parent::__construct(self::class, $value);
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
