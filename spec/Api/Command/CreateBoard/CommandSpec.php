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

use Aggrego\CommandConsumer\Command as ConsumerCommand;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\CommandConsumer\Version;
use Aggrego\Domain\Api\Command\CreateBoard\Command;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([], 'test', '1.0');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
        $this->shouldHaveType(ConsumerCommand::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldBeAnInstanceOf(Profile::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_version()
    {
        $this->getVersion()->shouldBeAnInstanceOf(Version::class);
    }

    function it_should_have_payload()
    {
        $this->getPayload()->shouldBeArray();
    }
}
