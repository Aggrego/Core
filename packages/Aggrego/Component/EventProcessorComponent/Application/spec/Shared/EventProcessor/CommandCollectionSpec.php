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

declare(strict_types=1);

namespace spec\Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor;

use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\CommandCollection as CommandLogicUnitCommandCollection;
use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\CommandCollection;
use PhpSpec\ObjectBehavior;

class CommandCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CommandCollection::class);
        $this->shouldImplement(CommandLogicUnitCommandCollection::class);
    }
}
