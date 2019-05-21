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

namespace spec\Aggrego\Domain\Board;

use Aggrego\Domain\Board\FromBoardFactory;
use Aggrego\Domain\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use PhpSpec\ObjectBehavior;

class FromBoardFactorySpec extends ObjectBehavior
{
    function let(
        BoardTransformationFactory $boardTransformationFactory
    ) {
        $this->beConstructedWith([], $boardTransformationFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FromBoardFactory::class);
    }
}
