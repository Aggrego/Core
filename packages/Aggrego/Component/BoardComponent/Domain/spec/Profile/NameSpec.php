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

declare(strict_types=1);

namespace spec\Aggrego\Component\BoardComponent\Domain\Profile;

use Aggrego\Component\BoardComponent\Domain\Profile\Exception\InvalidName;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;
use PhpSpec\ObjectBehavior;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('createFromParts', ['test', 'version']);
    }

    public function it_should_have_profile()
    {
        $this->getName()->shouldBeString();
    }

    function it_should_check_equal_profile()
    {
        $profile = Name::createFromParts('test', 'version');
        $this->equal($profile)->shouldBeBool();
    }

    function it_should_convert_to_string()
    {
        $this->beConstructedThrough('createFromParts', ['test', 'version']);
        $subject = $this->__toString();
        $subject->shouldBeString();
        $subject->shouldBe('test:version');
    }

    function it_should_throw_exception_when_name_hold_colon()
    {
        $this->beConstructedThrough('createFromParts', ['te:st', 'version']);
        $this->shouldThrow(InvalidName::name('te:st'))->duringInstantiation();
    }

    function it_should_throw_exception_when_version_hold_colon()
    {
        $this->beConstructedThrough('createFromParts', ['test', 'versi:on']);
        $this->shouldThrow(InvalidName::version('versi:on'))->duringInstantiation();
    }
}
