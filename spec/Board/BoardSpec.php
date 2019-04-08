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

namespace spec\Aggrego\DataDomainBoard\Board;

use Aggrego\DataDomainBoard\Board\Board;
use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\DataDomainBoard\Board\Prototype\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class BoardSpec extends ObjectBehavior
{
    function let()
    {
        $uuid = new Uuid('69d53395-7c1d-452d-ab5c-921575980f16');
        $key = new Key(['test']);
        $profile = Profile::createFromParts('test', '1.0');
        $metadata = new Metadata(new Data('test'));
        $parentUuid = new Uuid('69d53395-7c1d-452d-ab5c-921575980f16');
        $this->beConstructedWith($uuid, $key, $profile, $metadata, $parentUuid);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldReturnAnInstanceOf(Uuid::class);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldReturnAnInstanceOf(Profile::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldReturnAnInstanceOf(Key::class);
    }

    function it_should_have_metadata()
    {
        $this->getMetadata()->shouldReturnAnInstanceOf(Metadata::class);
    }
}
