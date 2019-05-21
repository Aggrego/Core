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

namespace spec\Aggrego\DataDomainBoard\Board;

use Aggrego\DataDomainBoard\Board\Data;
use PhpSpec\ObjectBehavior;

class DataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Data::class);
    }

    function it_should_have_value()
    {
        $this->getValue()->shouldBeString();
    }
}
