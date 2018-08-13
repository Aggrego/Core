<?php

namespace spec\Aggrego\Domain\Model\ProgressBoard\ValueObject;

use Assert\Assertion;
use Countable;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use stdClass;
use Aggrego\Domain\Model\ProgressBoard\Entity\FinalItem;
use Aggrego\Domain\Model\ProgressBoard\Entity\InitialItem;
use Aggrego\Domain\Model\ProgressBoard\Exception\InvalidUuidComparisonOnReplaceException;
use Aggrego\Domain\Model\ProgressBoard\ValueObject\Collection;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;
use Aggrego\Domain\ValueObject\Version;
use Traversable;

class ShardsSpec extends ObjectBehavior
{
    function let(InitialItem $initialShard)
    {
        $initialShard->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440000'));
        $initialShard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->beConstructedWith([$initialShard]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Collection::class);
        $this->shouldBeAnInstanceOf(Traversable::class);
        $this->shouldBeAnInstanceOf(Countable::class);
    }

    function it_should_throw_exception_with_other_object()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_be_able_to_replace_shards_initial_to_final_with_same_uuid(FinalItem $finalShard)
    {
        $finalShard->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440000'));
        $finalShard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->replace($finalShard)->shouldBeNull();
        Assertion::allIsInstanceOf($this->getWrappedObject(), FinalItem::class);
    }

    function it_should_be_able_to_throw_exception_replace_shards_initial_to_final_with_different_uuid(
        FinalItem $finalShard
    )
    {
        $finalShard->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440001'));
        $finalShard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->shouldThrow(InvalidUuidComparisonOnReplaceException::class)->during(
            'replace',
            [$finalShard]
        );
    }
}
