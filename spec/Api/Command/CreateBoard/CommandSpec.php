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
use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\Domain\Api\Command\CreateBoard\Command;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class CommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2', [], 'test', '1.0');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Command::class);
        $this->shouldHaveType(ConsumerCommand::class);
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
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

    function it_should_serialize()
    {
        $this->serialize()->shouldBeString();
    }

    function it_should_unserialize()
    {
        $this->unserialize(
            json_encode(
                [
                    'uuid' => '7835a2f1-65c4-4e05-aacf-2e9ed950f5f2',
                    'name' => Command::NAME,
                    'key' => [],
                    'profile_name' => 'test',
                    'profile_version' => '1.0'
                ]
            )
        )->shouldBeAnInstanceOf(Command::class);
    }
}
