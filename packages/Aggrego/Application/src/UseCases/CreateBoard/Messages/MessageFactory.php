<?php

declare(strict_types=1);

namespace Aggrego\Application\UseCases\CreateBoard\Messages;

use Aggrego\Application\UseCases\CreateBoard\Command;
use Aggrego\Domain\Board\Board;
use Aggrego\Infrastructure\Message\Addressee;
use Aggrego\Infrastructure\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Message\Factory\SenderFactory;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class MessageFactory
{
    private $senderFactory;

    private $messageIdFactory;

    public function __construct(
        SenderFactory $senderFactory,
        MessageIdFactory $messageIdFactory
    ) {
        $this->senderFactory = $senderFactory;
        $this->messageIdFactory = $messageIdFactory;
    }

    public function profileNotFound(Command $command): BoardNotCreated
    {
        return BoardNotCreated::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function unprocessableKeyChange(Command $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function unprocessablePrototype(Command $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function boardExist(Command $command): BoardNotCreated
    {
        return BoardNotCreated::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command
        );
    }

    public function boardCreated(Board $board, Command $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command,
            $board
        );
    }

    protected static function factoryAddress(Command $command): Addressee
    {
        return new class($command->getSender()->getValue()) extends StringValueObject implements Addressee {
            protected function guard(string $value): void
            {
            }
        };
    }
}
