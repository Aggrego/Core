<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\CreateBoard;

use Aggrego\Component\BoardComponent\Application\Message\AddresseeFactory;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\CreateBoardCommand;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages\BoardCreated;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages\BoardNotCreated;
use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Infrastructure\Contract\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Contract\Message\Factory\SenderFactory;

class MessageFactory
{
    public function __construct(
        private SenderFactory $senderFactory,
        private MessageIdFactory $messageIdFactory,
        private AddresseeFactory $addresseeFactory
    ) {
    }

    public function profileNotFound(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command
        );
    }

    public function unprocessableKeyChange(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            ''
        );
    }

    public function unprocessablePrototype(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            ''
        );
    }

    public function boardExist(CreateBoardCommand $command, Board $board): BoardNotCreated
    {
        return BoardNotCreated::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            $board->getId()
        );
    }

    public function boardCreated(Board $board, CreateBoardCommand $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            $board
        );
    }
}
