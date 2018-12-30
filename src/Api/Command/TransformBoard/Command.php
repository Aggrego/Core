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

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\CommandConsumer\Command as ConsumerCommand;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\CommandConsumer\Version;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid as BoardUuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Command implements ConsumerCommand
{
    /** @var Uuid */
    private $uuid;

    /** @var BoardUuid */
    private $boardUuid;

    /** @var Key */
    private $key;

    public function __construct(string $boardUuid, array $key)
    {
        $this->boardUuid = new BoardUuid($boardUuid);
        $this->key = new Key($key);
        $this->uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key) . $boardUuid
            )->toString()
        );
    }

    public function getBoardUuid(): BoardUuid
    {
        return $this->boardUuid;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getVersion(): Version
    {
        return new Version('1');
    }

    public function getPayload(): array
    {
        return [
            'uuid' => $this->getUuid()->getValue(),
            'version' => $this->getVersion()->getValue(),
            'key' => $this->key->getValue(),
            'board_uuid' => $this->boardUuid->getValue(),
        ];
    }
}
