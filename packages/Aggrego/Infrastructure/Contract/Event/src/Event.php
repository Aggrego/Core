<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event;

interface Event
{
    public function getDomain(): Domain;

    public function getName(): Name;

    public function createdAt(): CreatedAt;

    public function getVersion(): Version;

    public function getPayload(): Payload;
}
