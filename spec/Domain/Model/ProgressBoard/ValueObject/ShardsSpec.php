<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject;

use Assert\Assertion;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use stdClass;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\FinalShard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\InitialShard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Exception\InvalidUuidComparisonOnReplaceException;
use TimiTao\Construo\Domain\Model\ProgressBoard\ValueObject\Shards;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;
use Traversable;

class ShardsSpec extends ObjectBehavior
{
    function let(InitialShard $initialShard)
    {
        $initialShard->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440000'));
        $initialShard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->beConstructedWith([$initialShard]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Shards::class);
        $this->shouldBeAnInstanceOf(Traversable::class);
    }

    function it_should_throw_exception_with_other_object()
    {
        $this->beConstructedWith([new stdClass()]);
        $this->shouldThrow(InvalidArgumentException::class)->duringInstantiation();
    }

    function it_should_be_able_to_replace_shards_initial_to_final_with_same_uuid(FinalShard $finalShard)
    {
        $finalShard->getUuid()->willReturn(new Uuid('123e4567-e89b-12d3-a456-426655440000'));
        $finalShard->getAcceptableSource()->willReturn(new Source(new Name('test'), new Version('1.0')));
        $this->replace($finalShard)->shouldBeNull();
        Assertion::allIsInstanceOf($this->getWrappedObject(), FinalShard::class);
    }

    function it_should_be_able_to_throw_exception_replace_shards_initial_to_final_with_different_uuid(
        FinalShard $finalShard
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
