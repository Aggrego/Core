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

namespace spec\Aggrego\Domain\Profile;

use Aggrego\Domain\Profile\Profile;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class ProfileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('createFromParts', ['test', 'version']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Profile::class);
    }

    public function it_should_have_profile()
    {
        $this->getName()->shouldBeString();
    }

    function it_should_check_equal_profile()
    {
        $profile = Profile::createFromParts('test', 'version');
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
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_throw_exception_when_version_hold_colon()
    {
        $this->beConstructedThrough('createFromParts', ['test', 'versi:on']);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
