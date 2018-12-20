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
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid;
use PhpSpec\ObjectBehavior;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('69d53395-7c1d-452d-ab5c-921575980f16', ['test']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_should_have_board_uuid()
    {
        $this->getBoardUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }
}
