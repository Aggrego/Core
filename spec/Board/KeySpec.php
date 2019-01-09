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

namespace spec\Aggrego\Domain\Board;

use Aggrego\Domain\Board\Key;
use PhpSpec\ObjectBehavior;

class KeySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Key::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeArray();
    }
}
