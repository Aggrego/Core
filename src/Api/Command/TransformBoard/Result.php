<?php

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Board\Board;

class Result implements Response
{
    public const NAME = 'domain.transform_board.response';
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

    public function getName(): Name
    {
        return new Name(self::NAME);
    }
}
