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
use Aggrego\Domain\Board\Uuid;
use PhpSpec\ObjectBehavior;

class ResultSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fail', ['test']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Result::class);
        $this->shouldHaveType(Response::class);
    }

    function it_should_have_payload()
    {
        $this->getPayload()->shouldBeArray();
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
        $board->getUuid()->willReturn(new Uuid('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'));
        $this->beConstructedThrough('ok', [$board]);
        $this->isSuccess()->shouldReturn(true);
    }

    function it_should_be_created_fail_reponse()
    {
        $this->beConstructedThrough('fail', ['test']);
        $this->isSuccess()->shouldReturn(false);
    }
}
