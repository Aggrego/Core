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

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Profile\Profile;
use Aggrego\EventConsumer\Shared\Events;

interface Board
{
    public function getUuid(): Uuid;

    public function getProfile(): Profile;

    public function pullEvents(): Events;
}
