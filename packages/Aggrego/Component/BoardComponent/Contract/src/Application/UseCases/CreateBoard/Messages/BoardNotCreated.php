<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Contract\Application\UseCases\CreateBoard\Messages;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id as BoardId;
use Aggrego\Component\BoardComponent\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Contract\Message\CorrelatedCommand;
use Aggrego\Infrastructure\Contract\Message\Id;
use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\Message\Payload;
use Aggrego\Infrastructure\Contract\Message\Sender;
use Aggrego\Infrastructure\Contract\Message\Shared\BasicMessage;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\ArrayValueObject;

class BoardNotCreated extends BasicMessage implements Message
{
    public const CODE_PROFILE_NOT_FOUND = 140;

    public const CODE_UNPROCESSABLE_KEY_CHANGE = 141;

    public const CODE_UNPROCESSABLE_PROTOTYPE = 142;

    public const CODE_BOARD_EXIST = 143;

    private function __construct(
        Id $id,
        Sender $sender,
        CorrelatedCommand $correlatedCommand,
        int $code,
        string $message,
    )
    {
        $data = ['code' => $code, 'message' => $message];
        $payload = new class ($data) extends ArrayValueObject implements Payload {
        };
        parent::__construct($id, $sender, $payload, $correlatedCommand);
    }

    public static function profileNotFound(
        Id $id,
        Sender $sender,
        ProfileName $profile,
        CorrelatedCommand $correlatedCommand
    ): self
    {
        return new self(
            $id,
            $sender,
            $correlatedCommand,
            self::CODE_PROFILE_NOT_FOUND,
            sprintf('Profile "%s" not found.', $profile),
        );
    }

    public static function unprocessableKeyChange(
        Id $id,
        Sender $sender,
        string $message,
        CorrelatedCommand $correlatedCommand
    ): self
    {
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
        CorrelatedCommand $correlatedCommand
    ): self
    {
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
        CorrelatedCommand $correlatedCommand
    ): self
    {
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
}
