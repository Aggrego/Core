<?php

namespace TimiTao\Construo\Domain\Command\TransformBoard;

use TimiTao\Construo\Domain\Factory\ProfileBoardTransformationFactory;
use TimiTao\Construo\Domain\Model\ProgressBoard\Repository as ProgressBoardRepository;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\Repository as UnitRepository;
use TimiTao\Construo\Domain\ValueObject\Uuid;

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
