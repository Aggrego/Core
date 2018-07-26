<?php

namespace spec\TimiTao\Construo\Domain\Model\Unit\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Event\Aggregate;
use TimiTao\Construo\Domain\Exception\UnprocessableBoardException;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board as ProgressBoard;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Profile\BoardTransformation\Transformation;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;

class UnitSpec extends ObjectBehavior
{
    function let(Transformation $transformation)
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $board = new InitialBoard($key, new Profile($name, $version));
        $board->addShard($key, new Source($name, $version));
        $progressBoard = ProgressBoard::factoryFromInitial($board);
        $progressBoard->updateShard(
            new Uuid('4b7c7c15-6b50-5a1f-94ca-20a9749c5bc2'),
            new Source($name, $version),
            new Data('test')
        );

        $transformation->process($progressBoard->getShards())->willReturn(new Data(''));
        $this->beConstructedThrough('createFromBoard', [$progressBoard, $transformation]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Unit::class);
        $this->shouldImplement(Aggregate::class);
        $this->pullEvents()->shouldHaveCount(1);
    }

    function it_should_have_uuid()
    {
        $this->getUuid()->shouldBeAnInstanceOf(Uuid::class);
    }

    function it_should_have_key()
    {
        $this->getKey()->shouldBeAnInstanceOf(Key::class);
    }

    function it_should_have_profile()
    {
        $this->getProfile()->shouldBeAnInstanceOf(Profile::class);
    }

    function is_should_have_data()
    {
        $this->getData()->shouldBeAnInstanceOf(Data::class);
    }

    function it_should_throw_exception_when_got_unfinished_board(Transformation $transformation)
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $board = new InitialBoard($key, new Profile($name, $version));
        $board->addShard($key, new Source($name, $version));
        $progressBoard = ProgressBoard::factoryFromInitial($board);
        $transformation->process($progressBoard->getShards())->willReturn(new Data(''));

        $this->beConstructedThrough('createFromBoard', [$progressBoard, $transformation]);
        $this->shouldThrow(UnprocessableBoardException::class)->duringInstantiation();
    }
}
