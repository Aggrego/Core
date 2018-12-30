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

namespace spec\Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Api\Command\TransformBoard\UseCase;
use Aggrego\Domain\Board\FromBoardFactory;
use Aggrego\Domain\Board\Repository;
use PhpSpec\ObjectBehavior;

class UseCaseSpec extends ObjectBehavior
{
    function let(Repository $repository, FromBoardFactory $factory)
    {
        $this->beConstructedWith($repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UseCase::class);
    }
}
