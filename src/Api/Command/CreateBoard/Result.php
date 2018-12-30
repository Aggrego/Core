<?php

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Board\Board;

class Result implements Response
{
    private const SUCCESS_KEY = 'success';

    /** @var array */
    private $payload;

    private function __construct(array $data)
    {
        $this->payload = $data;
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
        return $this->payload[self::SUCCESS_KEY];
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
