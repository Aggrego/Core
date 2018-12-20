<?php

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Board\Board;

class Result
{
    private const SUCCESS_KEY = 'success';

    /** @var array */
    private $data;

    private function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function ok(Board $board): self
    {
        return new self(
            [
                self::SUCCESS_KEY => true,
                'board_uuid' => $board->getUuid()->getValue()
            ]
        );
    }

    public static function fail(string $reason): self
    {
        return new self(
            [
                self::SUCCESS_KEY => false,
                'error' => $reason
            ]
        );
    }

    public function isSuccess(): bool
    {
        return $this->data[self::SUCCESS_KEY];
    }

    public function getData(): array
    {
        return $this->data;
    }
}
