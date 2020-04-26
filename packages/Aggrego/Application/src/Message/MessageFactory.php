<?php

declare(strict_types=1);

namespace Aggrego\Application\Message;

use Aggrego\Infrastructure\Command\Command;
use Aggrego\Infrastructure\Message\Addressee;
use Aggrego\Infrastructure\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Message\Factory\SenderFactory;
use Aggrego\Infrastructure\Message\Message;
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

    public function failed(Command $command, int $code, string $message): Message
    {
        return Failed::create(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command->getId(),
            $code,
            $message
        );
    }

    public function notFound(Command $command, int $code, string $message): Message
    {
        return NotFound::create(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command->getId(),
            $code,
            $message
        );
    }

    public function success(Command $command, int $code): Message
    {
        return Success::create(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            self::factoryAddress($command),
            $command->getId(),
            $code
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
