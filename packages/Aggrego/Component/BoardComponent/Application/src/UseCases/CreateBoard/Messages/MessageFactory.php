<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\CreateBoard\Messages;

use Aggrego\Component\BoardComponent\Application\UseCases\CreateBoard\CreateBoardCommand;
use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Infrastructure\Message\Addressee;
use Aggrego\Infrastructure\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Message\Factory\SenderFactory;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class MessageFactory
{
    public function __construct(
        private SenderFactory $senderFactory,
        private MessageIdFactory $messageIdFactory
    ) {
    }

    public function profileNotFound(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function unprocessableKeyChange(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function unprocessablePrototype(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function boardExist(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function boardCreated(Board $board, CreateBoardCommand $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command,
            $board
        );
    }

    protected static function factoryAddress(CreateBoardCommand $command): Addressee
    {
        return new class($command->getSender()->getValue()) extends StringValueObject implements Addressee {
            protected function guard(string $value): void
            {
            }
        };
    }
}
