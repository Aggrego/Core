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

use Aggrego\Domain\Board\Uuid;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class UuidSpec extends ObjectBehavior
{
    private const UUID = '7835a2f1-65c4-4e05-aacf-2e9ed950f5f2';

    function let()
    {
        $this->beConstructedWith(self::UUID);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Uuid::class);
    }

    function it_should_have_value()
    {
        $value = $this->getValue();
        $value->shouldBeString();
        $value->shouldBe(self::UUID);
    }

    function it_should_throw_exception_for_invalid_format()
    {
        $this->beConstructedWith('invalid');
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }
}
