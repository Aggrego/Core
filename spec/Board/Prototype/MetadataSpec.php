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

namespace spec\Aggrego\DataBoard\Board\Prototype;

use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Prototype\Metadata;
use PhpSpec\ObjectBehavior;

class MetadataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Data('test'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Metadata::class);
    }

    function it_should_have_data()
    {
        $this->getData()->shouldBeAnInstanceOf(Data::class);
    }
}
