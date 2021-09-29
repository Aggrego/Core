<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\UseCases\TransformBoard;

use Aggrego\Component\BoardComponent\Application\Message\AddresseeFactory;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\Messages\BoardCreated;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\Messages\BoardNotTransformed;
use Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\TransformBoardCommand;
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

    public function boardNotFound(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function profileNotFound(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }

    public function unprocessableKeyChange(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            ''
        );
    }

    public function unprocessablePrototype(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            ''
        );
    }

    public function boardExist(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command
        );
    }

    public function boardCreated(Board $board, TransformBoardCommand $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $this->addresseeFactory->create($command->getSender()),
            $command,
            $board
        );
    }

    public function unprocessableBoard(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessableBoard(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factor(),
            $command
        );
    }
}
