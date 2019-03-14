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

use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Board\Board;

class Result implements Response
{
    public const NAME = 'domain.transform_board.response';
    private const SUCCESS_KEY = 'success';

    /**
     * @var array
     */
    private $payload;

    private function __construct(array $data)
    {
        $this->payload = $data;
    }

    public static function ok(Board $board): self
    {
        return new self(
            [
                self::SUCCESS_KEY => true,
                'board_uuid' => $board->getUuid()->getValue()
            ]
        );
    }

    public static function fail(string $reason): self
    {
        return new self(
            [
                self::SUCCESS_KEY => false,
                'error' => $reason
            ]
        );
    }

    public function isSuccess(): bool
    {
        return $this->payload[self::SUCCESS_KEY];
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getName(): Name
    {
        return new Name(self::NAME);
    }
}
