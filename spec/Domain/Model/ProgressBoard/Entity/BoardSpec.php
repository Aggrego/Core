<?php

namespace spec\TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use PhpSpec\ObjectBehavior;
use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board as InitialBoard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board;
use TimiTao\Construo\Domain\ValueObject\Data;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;
use TimiTao\Construo\Domain\ValueObject\Version;
use Traversable;

class BoardSpec extends ObjectBehavior
{
    function let()
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $board = new InitialBoard($key, new Profile($name, $version));
        $board->addShard($key, new Source($name, $version));
        $this->beConstructedThrough('factoryFromInitial', [$board]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
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

    function it_should_have_shards_as_list()
    {
        $this->getShards()->shouldBeAnInstanceOf(Traversable::class);
    }

    function it_should_return_true_with_all_final_shards()
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $board = new InitialBoard($key, new Profile($name, $version));
        $board->addShard($key, new Source($name, $version));
        $this->beConstructedThrough('factoryFromInitial', [$board]);
        $this->updateShard(
            new Uuid('4b7c7c15-6b50-5a1f-94ca-20a9749c5bc2'),
            new Source($name, $version),
            new Data('test')
        );

        $this->isAllShardsFinishedProgress()->shouldBe(true);
    }

    function it_should_return_false_with_any_initial_shard()
    {
        $key = new Key(['init']);
        $name = new Name('test');
        $version = new Version('1.0');
        $board = new InitialBoard($key, new Profile($name, $version));
        $board->addShard($key, new Source($name, $version));
        $this->beConstructedThrough('factoryFromInitial', [$board]);

        $this->isAllShardsFinishedProgress()->shouldBe(false);
    }

    function it_should_be_able_to_update_shard_with_data(Data $data)
    {
        $shardUuid = new Uuid('4b7c7c15-6b50-5a1f-94ca-20a9749c5bc2');
        $source = new Source(new Name('test'), new Version('1.0'));

        $this->updateShard($shardUuid, $source, $data)->shouldBeNull();
    }
}
