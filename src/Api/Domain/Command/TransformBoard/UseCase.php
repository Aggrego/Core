<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\TransformBoard;

use Aggrego\Domain\Api\Domain\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Profile\BoardTransformation\Exception\TransformationNotFoundException as BoardTransformationNotFoundException;
use Aggrego\Domain\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use Aggrego\Domain\ProgressiveBoard\Board;
use Aggrego\Domain\ProgressiveBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\ProgressiveBoard\Exception\UnfinishedStepPassedForTransformationException;
use Aggrego\Domain\ProgressiveBoard\Exception\UnprocessableBoardException;
use Aggrego\Domain\ProgressiveBoard\Repository as ProgressiveBoardRepository;

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

        try {
            Board::transformBoard($board, $this->boardTransformationFactory);
        } catch (BoardTransformationNotFoundException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        } catch (UnfinishedStepPassedForTransformationException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        } catch (UnprocessableBoardException $e) {
            throw new InvalidCommandDataException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
