<?php

namespace TimiTao\Construo\Domain\Query\GetUnit;

use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;
use TimiTao\Construo\Domain\Factory\KeySpecificationFactory;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;
use TimiTao\Construo\Domain\Model\Board\Repository as BoardRepository;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Name;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Shards;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Source;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Version;

class UseCase
{
    /** @var BoardRepository */
    private $boardRepository;

    /** @var KeySpecificationFactory */
    private $keySpecificationFactory;

    /** @var ProfileBoardFactory  */
    private $profileBoardFactory;

    public function __construct(
        BoardRepository $boardRepository,
        KeySpecificationFactory $keySpecificationFactory,
        ProfileBoardFactory $profileBoardFactory
    )
    {
        $this->boardRepository = $boardRepository;
        $this->keySpecificationFactory = $keySpecificationFactory;
        $this->profileBoardFactory = $profileBoardFactory;
    }

    public function handle(Query $query): Response
    {
        $key = new Key($query->getKey());
        $profile = new Profile(
            new Name($query->getProfileName()),
            new Version($query->getVersionNumber())
        );

        try {
            $keySpecification = $this->keySpecificationFactory->factory($profile);
        } catch (KeySpecificationNotFoundException $e) {
            return Response::createInvalidResponse($query);
        }
        if (!$keySpecification->isSatisfiedBy($key)) {
            return Response::createInvalidResponse($query);
        }

        $board = $this->boardRepository->findBoard($key);
        if (is_null($board)) {
            $boardFactory = $this->profileBoardFactory->factory($profile);
            $board = $boardFactory->factory($key, $profile);
            $this->boardRepository->addBoard($board);
        }
        return Response::createValidResponse($board);
    }
}
