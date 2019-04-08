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

namespace spec\Aggrego\DataDomainBoard\Board\Prototype;

use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\DataDomainBoard\Board\Prototype\Metadata;
use Aggrego\DataDomainBoard\Board\Prototype\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class BoardSpec extends ObjectBehavior
{
    function let(Key $key, Profile $profile, Data $data)
    {
        $this->beConstructedWith($key, $profile, $data);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldBeAnInstanceOf(Profile::class);
    }

    function it_should_have_metadata()
    {
        $this->getMetadata()->shouldBeAnInstanceOf(Metadata::class);
    }
}
