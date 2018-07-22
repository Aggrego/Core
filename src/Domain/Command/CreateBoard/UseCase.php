<?php

namespace TimiTao\Construo\Domain\Command\CreateBoard;

use TimiTao\Construo\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;
use TimiTao\Construo\Domain\Factory\KeySpecificationFactory;
use TimiTao\Construo\Domain\Factory\ProfileBoardFactory;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board as ProgressBoard;
use TimiTao\Construo\Domain\Model\ProgressBoard\Repository;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

class UseCase
{
    /** @var Repository */
    private $boardRepository;

    /** @var KeySpecificationFactory */
    private $keySpecificationFactory;

    /** @var ProfileBoardFactory */
    private $profileBoardFactory;

    public function __construct(
        Repository $boardRepository,
        KeySpecificationFactory $keySpecificationFactory,
        ProfileBoardFactory $profileBoardFactory
    )
    {
        $this->boardRepository = $boardRepository;
        $this->keySpecificationFactory = $keySpecificationFactory;
        $this->profileBoardFactory = $profileBoardFactory;
    }

    public function handle(Command $command): void
    {
        $key = new Key($command->getKey());
        $profile = new Profile(
            new Name($command->getProfileName()),
            new Version($command->getVersionNumber())
        );

        $keySpecification = $this->keySpecificationFactory->factory($profile);
        if (!$keySpecification->isSatisfiedBy($key)) {
            throw new ProfileKeySpecificationNotSatisfiedException();
        }

        $boardFactory = $this->profileBoardFactory->factory($profile);
        $initialBoard = $boardFactory->factory($key, $profile);
        $this->boardRepository->addBoard(ProgressBoard::factoryFromInitial($initialBoard));
    }
}
