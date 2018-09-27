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

use Aggrego\Domain\Api\Command\CreateBoard\UseCase;
use Aggrego\Domain\Board\NewBoardFactory;
use Aggrego\Domain\Board\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository, NewBoardFactory $factory)
    {
        $this->beConstructedWith($repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }
}
