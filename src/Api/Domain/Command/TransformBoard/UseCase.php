<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\TransformBoard;

use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Repository as ProgressiveBoardRepository;
use Aggrego\Domain\Api\Application\Model\Unit\Exception\UnitExistException;
use Aggrego\Domain\Api\Application\Model\Unit\Repository as UnitRepository;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Exception\TransformationNotFoundException as BoardTransformationNotFoundException;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Exception\TransformationNotFoundException as UnitTransformationNotFoundException;
use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Exception\UnprocessableUnitException;
use Aggrego\Domain\Api\Application\Profile\UnitTransformation\Factory as UnitTransformationFactory;
use Aggrego\Domain\Api\Domain\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Model\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException as BoardUnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Model\Unit\Exception\UnfinishedStepPassedForTransformationException as UnitUnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Model\Unit\Unit;

class UseCase
{
    /** @var ProgressiveBoardRepository */
    private $progressBoardRepository;

    /** @var UnitRepository */
    private $unitRepository;

    /** @var BoardTransformationFactory */
    private $boardTransformationFactory;

    /** @var UnitTransformationFactory */
    private $unitTransformationFactory;

    public function __construct(
        ProgressiveBoardRepository $progressBoardRepository,
        UnitRepository $unitRepository,
        BoardTransformationFactory $boardTransformationFactory,
        UnitTransformationFactory $unitTransformationFactory
    )
    {
        $this->progressBoardRepository = $progressBoardRepository;
        $this->unitRepository = $unitRepository;
        $this->boardTransformationFactory = $boardTransformationFactory;
        $this->unitTransformationFactory = $unitTransformationFactory;
    }

    /**
     * @param Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        try {
            $board = $this->progressBoardRepository->getBoardByUuid($command->getBoardUuid());
        } catch (BoardNotFoundException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }
        $profile = $board->getProfile();

        try {
            $transformation = $this->boardTransformationFactory->factory($profile);
        } catch (BoardTransformationNotFoundException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }

        if ($transformation->isLastState($board->getStep()->getState())) {
            try {
                $unitTransformation = $this->unitTransformationFactory->factory($profile);
                $this->unitRepository->addUnit(Unit::createFromBoard($board, $unitTransformation));
            } catch (UnitTransformationNotFoundException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            } catch (UnitUnfinishedStepPassedForTransformationException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            } catch (UnprocessableUnitException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            } catch (UnitExistException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            }
        } else {
            try {
                $board->transformStep($transformation);
            } catch (BoardUnfinishedStepPassedForTransformationException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            } catch (UnprocessableBoardException $e) {
                throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }
}
