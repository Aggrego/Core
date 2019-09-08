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

namespace spec\Aggrego\Application\Api\Command\TransformBoard;

use Aggrego\Application\Api\Command\TransformBoard\Command;
use Aggrego\Application\Api\Command\TransformBoard\UseCase;
use Aggrego\Application\Board\Board;
use Aggrego\Application\Board\FromBoardFactory;
use Aggrego\Application\Board\Key;
use Aggrego\Application\Board\Repository;
use Aggrego\Application\Board\Uuid;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository, FromBoardFactory $factory, Board $board)
    {
        $factory->fromBoard(Argument::type(Key::class), Argument::type(Board::class))->willReturn($board);
        $repository->getBoardByUuid(new Uuid('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2'))->willReturn($board);
        $repository->addBoard(Argument::type(Board::class));
        $this->beConstructedWith($repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }

    function it_should_handle()
    {
        $command = new Command('7835a2f1-65c4-4e05-aacf-2e9ed950f5f2', '7835a2f1-65c4-4e05-aacf-2e9ed950f5f2', []);
        $this->handle($command)->shouldReturn(null);
    }
}
