<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\Message;

use Aggrego\Infrastructure\Command\Id as CommandId;
use Aggrego\Infrastructure\Message\Addressee;
use Aggrego\Infrastructure\Message\Id;
use Aggrego\Infrastructure\Message\Message;
use Aggrego\Infrastructure\Message\Payload;
use Aggrego\Infrastructure\Message\Sender;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

abstract class BaseMessage implements Message
{
    public const CODE_CREATED = 120;

    private $id;

    private $sender;

    private $addressee;

    private $code;

    private $message;

    private $sourceCommandId;

    protected function __construct(
        Id $id,
        Sender $sender,
        Addressee $addressee,
        CommandId $sourceCommandId,
        int $code,
        ?string $message
    ) {
        $this->id = $id;
        $this->sender = $sender;
        $this->addressee = $addressee;
        $this->code = $code;
        $this->message = $message;
        $this->sourceCommandId = $sourceCommandId;
    }

    public static function create(
        Id $id,
        Sender $sender,
        Addressee $addressee,
        CommandId $commandId,
        int $code,
        ?string $message = null
    ): self {
        return new static(
            $id,
            $sender,
            $addressee,
            $commandId,
            $code,
            $message
        );
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function getAddressee(): Addressee
    {
        return $this->addressee;
    }

    public function getPayload(): Payload
    {
        $data = [
            'id' => $this->id->getValue(),
            'sender' => $this->sender->getValue(),
            'addressee' => $this->addressee->getValue(),
            'source_command_id' => $this->sourceCommandId->getValue(),
            'code' => $this->code,
            'message' => $this->message,
        ];

        return new class($data) extends ArrayValueObject implements Payload {
            protected function guard(array $value): void
            {
                return;
            }
        };
    }
}
