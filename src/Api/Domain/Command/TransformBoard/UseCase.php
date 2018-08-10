<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\TransformBoard;

use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\Api\Application\Model\ProgressiveBoard\Repository as ProgressiveBoardRepository;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Exception\TransformationNotFoundException as BoardTransformationNotFoundException;
use Aggrego\Domain\Api\Application\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use Aggrego\Domain\Api\Domain\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Model\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\Model\ProgressiveBoard\Exception\UnprocessableBoardException;

class UseCase
{
    /** @var ProgressiveBoardRepository */
    private $progressBoardRepository;

    /** @var BoardTransformationFactory */
    private $boardTransformationFactory;

    public function __construct(
        ProgressiveBoardRepository $progressBoardRepository,
        BoardTransformationFactory $boardTransformationFactory
    )
    {
        $this->progressBoardRepository = $progressBoardRepository;
        $this->boardTransformationFactory = $boardTransformationFactory;
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

        try {
            $board->transformStep($transformation);
        } catch (UnfinishedStepPassedForTransformationException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        } catch (UnprocessableBoardException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
