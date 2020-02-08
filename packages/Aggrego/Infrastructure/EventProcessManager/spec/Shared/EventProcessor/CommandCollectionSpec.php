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

namespace spec\Aggrego\Infrastructure\EventProcessManager\Shared\EventProcessor;

use Aggrego\Infrastructure\EventProcessManager\EventProcessor\CommandCollection as CommandLogicUnitCommandCollection;
use Aggrego\Infrastructure\EventProcessManager\EventProcessor\CommandCollection;
use PhpSpec\ObjectBehavior;

class CommandCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CommandCollection::class);
        $this->shouldImplement(CommandLogicUnitCommandCollection::class);
    }
}
