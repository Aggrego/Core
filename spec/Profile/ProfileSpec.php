<?php

declare(strict_types = 1);

namespace spec\Aggrego\Domain\Profile;

use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class ProfileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('createFrom', ['test', 'version']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Profile::class);
    }

    function it_should_check_equal_profile()
    {
        $profile = Profile::createFrom('test', 'version');
        $this->equal($profile)->shouldBeBool();
    }

    function it_should_convert_to_string()
    {
        $this->beConstructedThrough('createFrom', ['test', 'version']);
        $subject = $this->__toString();
        $subject->shouldBeString();
        $subject->shouldBe('test:version');
    }
}
