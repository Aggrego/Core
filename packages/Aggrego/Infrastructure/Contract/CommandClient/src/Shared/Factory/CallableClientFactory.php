<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\CommandClient\Shared\Factory;

use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\MessageClient\Client;

class CallableClientFactory
{
    public function __construct(
        private object $service,
        private string $method,
    ) {
    }

    public function __invoke(): Client
    {
        return new class ($this->service, $this->method) implements Client
        {
            public function __construct(
                private object $service,
                private string $method
            ) {
            }

            public function consume(Message $message): void
            {
                $callable = [$this->service, $this->method];
                if (!is_callable($callable)) {
                    throw new \Exception('Invalid configuration. Expected callable.');
                }
                call_user_func($callable, $message);
            }
        };
    }
}
