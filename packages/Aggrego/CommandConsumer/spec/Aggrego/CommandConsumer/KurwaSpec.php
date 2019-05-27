<?php

namespace spec\Aggrego\CommandConsumer;

use Aggrego\CommandConsumer\Kurwa;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KurwaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Kurwa::class);
    }
}
