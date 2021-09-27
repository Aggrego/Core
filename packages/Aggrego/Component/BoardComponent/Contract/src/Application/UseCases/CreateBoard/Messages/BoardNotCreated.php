<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages;

use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\CreateBoardCommand;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Id as BoardId;
use Aggrego\Infrastructure\Command\Id as CommandId;
use Aggrego\Infrastructure\Message\Addressee;
use Aggrego\Infrastructure\Message\Id;
use Aggrego\Infrastructure\Message\Message;
use Aggrego\Infrastructure\Message\Payload;
use Aggrego\Infrastructure\Message\Sender;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

class BoardNotCreated implements Message
{
    public const CODE_PROFILE_NOT_FOUND = 140;

    public const CODE_UNPROCESSABLE_KEY_CHANGE = 141;

    public const CODE_UNPROCESSABLE_PROTOTYPE = 142;

    public const CODE_BOARD_EXIST = 143;

    private function __construct(
        private Id        $id,
        private Sender    $sender,
        private Addressee $addressee,
        private int       $code,
        private string    $message,
        private CommandId $sourceCommandId
    ) {
    }

    public static function profileNotFound(Id $id, Sender $sender, Addressee $addressee, CreateBoardCommand $command)
    {
        return new self(
            $id,
            $sender,
            $addressee,
            self::CODE_PROFILE_NOT_FOUND,
            sprintf('Profile "%s" not found.', $command->getProfile()),
            $command->getId()
        );
    }

    public static function unprocessableKeyChange(
        Id                 $id,
        Sender             $sender,
        Addressee          $addressee,
        CreateBoardCommand $command,
        string             $message
    ): self {
        return new self(
            $id,
            $sender,
            $addressee,
            self::CODE_UNPROCESSABLE_KEY_CHANGE,
            sprintf('Key is unprocessable, due to: %s', $message),
            $command->getId()
        );
    }

    public static function unprocessablePrototype(
        Id                 $id,
        Sender             $sender,
        Addressee          $addressee,
        CreateBoardCommand $command,
        string             $message
    ): self {
        return new self(
            $id,
            $sender,
            $addressee,
            self::CODE_UNPROCESSABLE_PROTOTYPE,
            sprintf('Prototype is unprocessable, due to: %s', $message),
            $command->getId()
        );
    }

    public static function boardExist(
        Id                 $id,
        Sender             $sender,
        Addressee          $addressee,
        CreateBoardCommand $command,
        BoardId            $boardId
    ): self {
        return new self(
            $id,
            $sender,
            $addressee,
            self::CODE_BOARD_EXIST,
            sprintf(
                'Try to create board with "%s" that exists.',
                $boardId->getValue()
            ),
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
            'source_command_id' => $this->sourceCommandId->getValue(),
        ];

        return new class($data) extends ArrayValueObject implements Payload {
            protected function guard(array $value): void
            {
            }
        };
    }
}
