<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\Application\Api\Command\TransformBoard;

use Aggrego\Application\Board\Id\Uuid as BoardUuid;
use Aggrego\CommandConsumer\Command as ConsumerCommand;
use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\Domain\Profile\KeyChange;
use Assert\Assertion;

class Command implements ConsumerCommand
{
    public const NAME = 'Aggrego/Domain/TransformBoard';

    private $uuid;

    private $boardUuid;

    private $key;

    public function __construct(string $uuid, string $boardUuid, array $key)
    {
        $this->uuid = new Uuid($uuid);
        $this->boardUuid = new BoardUuid($boardUuid);
        $this->key = new KeyChange($key);
    }

    public function getBoardUuid(): BoardUuid
    {
        return $this->boardUuid;
    }

    public function getKey(): KeyChange
    {
        return $this->key;
    }

    public function getName(): Name
    {
        return new Name(self::NAME);
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function serialize()
    {
        return json_encode([
            'uuid' => $this->getUuid()->getValue(),
            'name' => $this->getName()->getValue(),
            'key' => $this->key->getValue(),
            'board_uuid' => $this->boardUuid->getValue(),
        ]);
    }

    public function unserialize($serialized): self
    {
        $json = json_decode($serialized, true);
        Assertion::keyExists($json, 'uuid');
        Assertion::keyExists($json, 'name');
        Assertion::eq($json['name'], self::NAME);
        Assertion::keyExists($json, 'key');
        Assertion::keyExists($json, 'board_uuid');

        $this->uuid = new Uuid($json['uuid']);
        $this->boardUuid = new BoardUuid($json['board_uuid']);
        $this->key = new KeyChange($json['key']);

        return $this;
    }
}
