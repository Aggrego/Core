<?php

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Factory\ProfileBoardTransformationFactory;
use Aggrego\Domain\Model\ProgressBoard\Repository as ProgressBoardRepository;
use Aggrego\Domain\Model\Unit\Entity\Unit;
use Aggrego\Domain\Model\Unit\Repository as UnitRepository;
use Aggrego\Domain\ValueObject\Uuid;

class UseCase
{
    /** @var ProgressBoardRepository */
    private $progressBoardRepository;

    /** @var UnitRepository */
    private $unitRepository;

    /** @var ProfileBoardTransformationFactory */
    private $transformationFactory;

    public function __construct(
        ProgressBoardRepository $progressBoardRepository,
        UnitRepository $unitRepository,
        ProfileBoardTransformationFactory $transformationFactory
    )
    {
        $this->progressBoardRepository = $progressBoardRepository;
        $this->unitRepository = $unitRepository;
        $this->transformationFactory = $transformationFactory;
    }

    public function handle(Command $command): void
    {
        $board = $this->progressBoardRepository->getBoardByUuid(new Uuid($command->getBoardUuid()));
        $transformation = $this->transformationFactory->factory($board->getProfile());
        $this->unitRepository->addUnit(Unit::createFromBoard($board, $transformation));
    }
}
