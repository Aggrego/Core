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

namespace spec\Aggrego\Application\Board;

use Aggrego\Application\Board\NewBoardFactory;
use Aggrego\Application\Profile\BoardConstruction\Factory as BoardConstructionFactory;
use PhpSpec\ObjectBehavior;

class NewBoardFactorySpec extends ObjectBehavior
{
    function let(
        BoardConstructionFactory $boardConstructionFactory
    ) {
        $this->beConstructedWith([], $boardConstructionFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NewBoardFactory::class);
    }
}
