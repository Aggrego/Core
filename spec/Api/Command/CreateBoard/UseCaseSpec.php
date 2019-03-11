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

use Aggrego\Domain\Api\Command\CreateBoard\Command;
use Aggrego\Domain\Api\Command\CreateBoard\UseCase;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\NewBoardFactory;
use Aggrego\Domain\Board\Repository;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository, NewBoardFactory $factory, Board $board)
    {
        $factory->newBoard(Argument::type(Key::class), Argument::type(Profile::class))->willReturn($board);
        $this->beConstructedWith($repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle()
    {
        $command = new Command('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2', [], 'test', '1.0');
        $this->handle($command)->shouldReturn(null);
    }
}
