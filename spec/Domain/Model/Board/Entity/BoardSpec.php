<?php

namespace spec\TimiTao\Construo\Domain\Model\Board\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Status;

class BoardSpec extends ObjectBehavior
{
    function let(Key $key, Profile $profile, Shards $shards)
    {
        $this->beConstructedWith($key, $profile, $shards);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_status()
    {
        $subject = $this->getStatus();
        $subject->shouldBeAnInstanceOf(Status::class);
        $subject->getValue()->shouldBe(Status::INITIAL);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldBeAnInstanceOf(Profile::class);
    }

    function it_should_have_shards_as_list()
    {
        $this->getShards()->shouldBeAnInstanceOf(Shards::class);
    }

}
