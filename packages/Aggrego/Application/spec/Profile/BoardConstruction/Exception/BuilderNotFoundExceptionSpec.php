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

namespace spec\Aggrego\Application\Profile\BoardConstruction\Exception;

use Aggrego\Application\Profile\BoardConstruction\Exception\BuilderNotFoundException;
use Aggrego\Application\Shared\Exception\RuntimeException;
use PhpSpec\ObjectBehavior;

class BuilderNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BuilderNotFoundException::class);
        $this->shouldBeAnInstanceOf(RuntimeException::class);
    }
}
