<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\CommandConsumer\Command as ConsumerCommand;
use Aggrego\CommandConsumer\Name;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid as BoardUuid;

class Command implements ConsumerCommand
{
    public const NAME = 'domain.transform_board';

    /**
     * @var BoardUuid 
     */
    private $boardUuid;

    /**
     * @var Key 
     */
    private $key;

    public function __construct(string $boardUuid, array $key)
    {
        $this->boardUuid = new BoardUuid($boardUuid);
        $this->key = new Key($key);
    }

    public function getBoardUuid(): BoardUuid
    {
        return $this->boardUuid;
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getName(): Name
    {
        return new Name(self::NAME);
    }

    public function getPayload(): array
    {
        return [
            'key' => $this->key->getValue(),
            'board_uuid' => $this->boardUuid->getValue(),
        ];
    }
}
