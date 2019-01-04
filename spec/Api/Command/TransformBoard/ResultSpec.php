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

namespace spec\Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\CommandConsumer\Response;
use Aggrego\Domain\Api\Command\TransformBoard\Result;
use PhpSpec\ObjectBehavior;

class ResultSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Result::class);
        $this->shouldHaveType(Response::class);
    }
}
