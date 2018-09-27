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

namespace spec\Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Api\Command\CreateBoard\Command;
use PhpSpec\ObjectBehavior;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'test', '1.0');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }
}
