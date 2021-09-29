<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\Messages;

use Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\TransformBoardCommand;
use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Id as BoardId;
use Aggrego\Infrastructure\Contract\Command\Id as CommandId;
use Aggrego\Infrastructure\Contract\Message\Addressee;
use Aggrego\Infrastructure\Contract\Message\Id;
use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\Message\Payload;
use Aggrego\Infrastructure\Contract\Message\Sender;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

class BoardCreated implements Message
{
    public const CODE_CREATED = 220;

    private function __construct(
        private Id $id,
        private Sender $sender,
        private Addressee $addressee,
        private int $code,
        private string $message,
        private BoardId $boardId,
        private CommandId $sourceCommandId
    ) {
    }

    public static function boardCreated(
        Id $id,
        Sender $sender,
        Addressee $addressee,
        TransformBoardCommand $command,
        Board $board
    ): self {
        return new self(
            $id,
            $sender,
            $addressee,
            self::CODE_CREATED,
            sprintf('Board "%s" created.', $board->getId()->getValue()),
            $board->getId(),
            $command->getId()
        );
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function getAddressee(): Addressee
    {
        return $this->addressee;
    }

    public function getPayload(): Payload
    {
        $data = [
            'id' => $this->id->getValue(),
            'sender' => $this->sender->getValue(),
            'addressee' => $this->addressee->getValue(),
            'code' => $this->code,
            'message' => $this->message,
            'board_id' => $this->boardId->getValue(),
            'source_command_id' => $this->sourceCommandId->getValue(),
        ];

        return new class ($data) extends ArrayValueObject implements Payload {
            /** @param array<mixed> $value */
            protected function guard(array $value): void
            {
            }
        };
    }
}
