<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Model\ProgressiveBoard\Board;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class BoardCreatedEvent extends Event
{
    public function __construct(Board $board)
    {
        parent::__construct(
            [
                'uuid' => $board->getUuid()->getValue(),
                'key' => $board->getKey()->getValue(),
                'profile' => [
                    'name' => $board->getProfile()->getName()->getValue(),
                    'version' => $board->getProfile()->getVersion()->getValue(),
                ],
            ]
        );
    }
}
