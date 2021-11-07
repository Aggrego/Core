<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard\Messages;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id as BoardId;
use Aggrego\Infrastructure\Contract\Message\CorrelatedCommand;
use Aggrego\Infrastructure\Contract\Message\Id;
use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\Message\Payload;
use Aggrego\Infrastructure\Contract\Message\Sender;
use Aggrego\Infrastructure\Contract\Message\Shared\BasicMessage;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\ArrayValueObject;

class BoardNotTransformed extends BasicMessage implements Message
{
    public const CODE_PROFILE_NOT_FOUND = 240;

    public const CODE_UNPROCESSABLE_KEY_CHANGE = 241;

    public const CODE_UNPROCESSABLE_PROTOTYPE = 242;

    public const CODE_BOARD_EXIST = 243;

    public function __construct(
        Id $id,
        Sender $sender,
        CorrelatedCommand $correlatedCommand,
        int $code,
        string $message,
    ) {
        $data = ['code' => $code, 'message' => $message];
        $payload = new class ($data) extends ArrayValueObject implements Payload {
        };
        parent::__construct($id, $sender, $payload, $correlatedCommand);
    }

    public static function profileNotFound(
        Id $id,
        Sender $sender,
        BoardId $boardId,
        CorrelatedCommand $correlatedCommand
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_PROFILE_NOT_FOUND,
            sprintf('Profile not found from board "%s".', $boardId->getValue()),
        );
    }

    public static function unprocessableKeyChange(
        Id $id,
        Sender $sender,
        CorrelatedCommand $correlatedCommand,
        string $message,
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_UNPROCESSABLE_KEY_CHANGE,
            sprintf('Key is unprocessable, due to: %s', $message),
        );
    }

    public static function unprocessablePrototype(
        Id $id,
        Sender $sender,
        string $message,
        CorrelatedCommand $correlatedCommand,
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_UNPROCESSABLE_PROTOTYPE,
            sprintf('Prototype is unprocessable, due to: %s', $message),
        );
    }

    public static function boardExist(
        Id $id,
        Sender $sender,
        BoardId $boardId,
        CorrelatedCommand $correlatedCommand,
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_BOARD_EXIST,
            sprintf(
                'Try to create board with "%s" that exists.',
                $boardId->getValue()
            ),
        );
    }

    public static function boardNotFound(
        Id $id,
        Sender $sender,
        BoardId $boardId,
        CorrelatedCommand $correlatedCommand,
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_BOARD_EXIST,
            sprintf('Board "%s" not found.', $boardId->getValue()),
        );
    }

    public static function unprocessableBoard(
        Id $id,
        Sender $sender,
        BoardId $boardId,
        string $message,
        CorrelatedCommand $correlatedCommand,
    ): self {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_BOARD_EXIST,
            sprintf('Board "%s" is unprocessable, due to: %s', $boardId->getValue(), $message),
        );
    }
}
