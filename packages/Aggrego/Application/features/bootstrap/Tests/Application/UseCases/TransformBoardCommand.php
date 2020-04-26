<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Aggrego\Application\UseCases\TransformBoard\Command;
use Aggrego\Domain\Board\Id\Id as BoardId;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Infrastructure\Command\Id;
use Aggrego\Infrastructure\Command\Payload;
use Aggrego\Infrastructure\Command\Sender;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class TransformBoardCommand implements Command
{
    private $boardId;

    private $key;

    public function __construct(string $boardId, array $key)
    {
        $this->boardId = $boardId;
        $this->key = $key;
    }

    public function getKey(): KeyChange
    {
        return new KeyChange($this->key);
    }

    public function getId(): Id
    {
        return new class('1') extends StringValueObject implements Id {
            protected function guard(string $value): void
            {
            }
        };
    }

    public function getSender(): Sender
    {
        return new class('test') extends StringValueObject implements Sender {
            protected function guard(string $value): void
            {
            }
        };
    }

    public function getPayload(): Payload
    {
        return new class([]) extends ArrayValueObject implements Payload {
            protected function guard(array $value): void
            {
            }
        };
    }

    public function getBoardId(): BoardId
    {
        return new class($this->boardId) extends StringValueObject implements BoardId {
            protected function guard(string $value): void
            {
            }
        };
    }
}
