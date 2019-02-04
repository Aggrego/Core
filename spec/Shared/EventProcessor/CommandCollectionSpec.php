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

namespace spec\Aggrego\CommandLogicUnit\Shared\EventProcessor;

use Aggrego\CommandLogicUnit\EventProcessor\CommandCollection as CommandLogicUnitCommandCollection;
use Aggrego\CommandLogicUnit\Shared\EventProcessor\CommandCollection;
use PhpSpec\ObjectBehavior;

class CommandCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CommandCollection::class);
        $this->shouldImplement(CommandLogicUnitCommandCollection::class);
    }
}
