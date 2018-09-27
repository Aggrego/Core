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

namespace spec\Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Api\Command\TransformBoard\Command;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('69d53395-7c1d-452d-ab5c-921575980f16');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }
}
