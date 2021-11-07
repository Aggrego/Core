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
use Aggrego\Component\BoardComponent\Domain\Board\Factory\Exception\UnprocessablePrototype;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
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

    public function boardNotFound(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $command->getBoardId(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function profileNotFound(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::profileNotFound(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $command->getBoardId(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function unprocessableKeyChange(
        TransformBoardCommand $command,
        UnprocessableKeyChange $e
    ): BoardNotTransformed {
        return BoardNotTransformed::unprocessableKeyChange(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $this->correlatedCommandFactory->factory($command),
            $e->getMessage(),
        );
    }

    public function unprocessablePrototype(
        TransformBoardCommand $command,
        UnprocessablePrototype $e
    ): BoardNotTransformed {
        return BoardNotTransformed::unprocessablePrototype(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $e->getMessage(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function boardExist(TransformBoardCommand $command): BoardNotTransformed
    {
        return BoardNotTransformed::boardExist(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $command->getBoardId(),
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function boardCreated(Board $board, TransformBoardCommand $command): BoardCreated
    {
        return BoardCreated::boardCreated(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $board,
            $this->correlatedCommandFactory->factory($command)
        );
    }

    public function unprocessableBoard(TransformBoardCommand $command, UnprocessableBoard $e): BoardNotTransformed
    {
        return BoardNotTransformed::unprocessableBoard(
            $this->messageIdFactory->factory(),
            $this->senderFactory->factory(),
            $command->getBoardId(),
            $e->getMessage(),
            $this->correlatedCommandFactory->factory($command)
        );
    }
}
