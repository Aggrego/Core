<?php

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\CreateBoard;

use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\CreateBoardCommand;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages\BoardCreated;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages\BoardNotCreated;
use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Profile\Building\Exception\UnprocessableKeyChange;
use Aggrego\Infrastructure\Contract\Message\Factory\CorrelatedCommandFactory;
use Aggrego\Infrastructure\Contract\Message\Factory\IdFactory as MessageIdFactory;
use Aggrego\Infrastructure\Contract\Message\Factory\SenderFactory;

class MessageFactory
{
    public function __construct(
        private SenderFactory $senderFactory,
        private MessageIdFactory $messageIdFactory,
        private CorrelatedCommandFactory $correlatedCommandFactory
    ) {
    }

    public function profileNotFound(CreateBoardCommand $command): BoardNotCreated
    {
        return BoardNotCreated::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $command->getProfile(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function unprocessableKeyChange(CreateBoardCommand $command, UnprocessableKeyChange $e): BoardNotCreated
    {
        return BoardNotCreated::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $e->getMessage(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function unprocessablePrototype(CreateBoardCommand $command, UnprocessablePrototype $e): BoardNotCreated
    {
        return BoardNotCreated::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $e->getMessage(),
            $this->correlatedCommandFactory->factory($command),

        );
    }

    public function boardExist(CreateBoardCommand $command, Board $board): BoardNotCreated
    {
        return BoardNotCreated::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $board->getId(),
            $this->correlatedCommandFactory->factory($command),
        );
    }

    public function boardCreated(Board $board, CreateBoardCommand $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $this->correlatedCommandFactory->factory($command),
            $board
        );
    }
}
