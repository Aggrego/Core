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

namespace spec\Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Api\Command\CreateBoard\Result;
use Aggrego\Domain\Board\Board;
use PhpSpec\ObjectBehavior;

class ResultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Result::class);
        $this->shouldHaveType(Response::class);
    }

    function it_should_have_payload()
    {
        $this->getPayload()->shouldBeArrray();
    }

    function it_should_consider_success()
    {
        $this->isSuccess()->shouldBeBool();
    }

    function is_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_should_be_created_ok_reponse(Board $board)
    {
        $this->beConstructedThrough('ok', [$board]);
        $this->isSuccess()->shouldReturnTrue();
    }

    function it_should_be_created_fail_reponse()
    {
        $this->beConstructedThrough('fail', ['test']);
        $this->isSuccess()->shouldReturnFalse();
    }
}
