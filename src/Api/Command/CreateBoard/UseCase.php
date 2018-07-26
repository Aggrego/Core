<?php

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Exception\ProfileKeySpecificationNotSatisfiedException;
use Aggrego\Domain\Factory\ProfileBoardFactory;
use Aggrego\Domain\Factory\ProfileKeySpecificationFactory;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board as ProgressBoard;
use Aggrego\Domain\Model\ProgressBoard\Repository;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

class UseCase
{
    /** @var Repository */
    private $boardRepository;

    /** @var ProfileKeySpecificationFactory */
    private $keySpecificationFactory;

    /** @var ProfileBoardFactory */
    private $profileBoardFactory;

    public function __construct(
        Repository $boardRepository,
        ProfileKeySpecificationFactory $keySpecificationFactory,
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
