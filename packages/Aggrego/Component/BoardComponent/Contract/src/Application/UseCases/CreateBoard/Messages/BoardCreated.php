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

use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Infrastructure\Contract\Message\CorrelatedCommand;
use Aggrego\Infrastructure\Contract\Message\Id;
use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\Message\Payload;
use Aggrego\Infrastructure\Contract\Message\Sender;
use Aggrego\Infrastructure\Contract\Message\Shared\BasicMessage;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\ArrayValueObject;

class BoardCreated extends BasicMessage implements Message
{
    public const CODE_CREATED = 120;

    public static function boardCreated(
        Id $id,
        Sender $sender,
        CorrelatedCommand $correlatedCommand,
        Board $board
    ): self {
        $data = [
            'code' => self::CODE_CREATED,
            'message' => sprintf('Board "%s" created.', $board->getId()->getValue()),
            'board_id' => $board->getId()->getValue(),
        ];
        $payload = new class ($data) extends ArrayValueObject implements Payload {
        };

        return new self(
            $id,
            $sender,
            $payload,
            $correlatedCommand,
        );
    }
}
