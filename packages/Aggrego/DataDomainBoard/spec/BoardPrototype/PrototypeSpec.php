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

namespace spec\Aggrego\DataDomainBoard\BoardPrototype;

use Aggrego\Domain\BoardPrototype\Metadata;
use Aggrego\Domain\BoardPrototype\Name;
use Aggrego\Domain\Profile\Name as ProfileName;
use PhpSpec\ObjectBehavior;

class PrototypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Name('test'), ProfileName::createFromName('a:b'), new Metadata([]), null);
    }

    function it_has_name()
    {
        $this->getName()->shouldBeAnInstanceOf(Name::class);
    }

    function it_has_profile_name()
    {
        $this->getProfileName()->shouldBeAnInstanceOf(ProfileName::class);
    }

    function it_has_metadata()
    {
        $this->getMetadata()->shouldBeAnInstanceOf(Metadata::class);
    }

    function it_check_if_has_parent()
    {
        $this->hasParentId()->shouldBe(false);
    }
}
