<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Message;

use Aggrego\Infrastructure\Contract\Command\Sender;
use Aggrego\Infrastructure\Contract\Message\Addressee;

interface AddresseeFactory
{
    public function create(Sender $sender): Addressee;
}
