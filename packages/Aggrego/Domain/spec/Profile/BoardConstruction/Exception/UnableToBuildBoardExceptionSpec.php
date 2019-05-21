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

namespace spec\Aggrego\Domain\Profile\BoardConstruction\Exception;

use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class UnableToBuildBoardExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnableToBuildBoardException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
