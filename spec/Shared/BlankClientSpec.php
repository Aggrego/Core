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

namespace spec\Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Client;
use Aggrego\EventConsumer\Shared\BlankClient;
use PhpSpec\ObjectBehavior;

class BlankClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlankClient::class);
        $this->shouldBeAnInstanceOf(Client::class);
    }
}
