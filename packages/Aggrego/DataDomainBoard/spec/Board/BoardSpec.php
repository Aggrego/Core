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

namespace spec\Aggrego\DataDomainBoard\Board;

use Aggrego\DataDomainBoard\Board\Board;
use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Board\Name;
use Aggrego\Domain\Profile\Name as ProfileName;
use PhpSpec\ObjectBehavior;

class BoardSpec extends ObjectBehavior
{
    function let(Id $id, Id $parentId)
    {
        $id->getValue()->willReturn('1');
        $parentId->getValue()->willReturn('2');
        $profileName = ProfileName::createFromParts('test', '1.0');
        $name = new Name('data_board');
        $this->beConstructedWith($id, $name, $profileName, $parentId, new Data('test'));
    }

    function it_should_have_id()
    {
        $this->getId()->shouldReturnAnInstanceOf(Id::class);
    }

    function it_should_have_profile()
    {
        $this->getProfileName()->shouldReturnAnInstanceOf(ProfileName::class);
    }

    function it_should_have_metadata()
    {
        $this->getData()->shouldReturnAnInstanceOf(Data::class);
    }
}
