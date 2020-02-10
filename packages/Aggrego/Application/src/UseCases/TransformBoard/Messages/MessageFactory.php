<?php

declare(strict_types=1);

namespace Aggrego\Application\UseCases\TransformBoard\Messages;

use Aggrego\Application\UseCases\TransformBoard\Command;
use Aggrego\Domain\Board\Board;
use Aggrego\Infrastructure\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Message\Factory\SenderFactory;

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

    public function boardNotFound(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function profileNotFound(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function unprocessableKeyChange(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function unprocessablePrototype(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function boardExist(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function boardCreated(Board $board, Command $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command,
            $board
        );
    }

    public function unprocessableBoard(Command $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessableBoard(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }
}
