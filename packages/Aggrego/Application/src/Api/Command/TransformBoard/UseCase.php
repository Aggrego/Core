<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\Api\Command\TransformBoard;

use Aggrego\Application\Board\BoardRepository;
use Aggrego\Application\Profile\Transformation\TransformationProfileRepository;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Id\IdFactory;

class UseCase
{
    private $boardRepository;

    private $transformationProfileRepository;

    private $boardFactory;

    private $idFactory;

    public function __construct(
        BoardRepository $boardRepository,
        TransformationProfileRepository $transformationProfileRepository,
        BoardFactory $boardFactory,
        IdFactory $idFactory
    ) {
        $this->boardRepository = $boardRepository;
        $this->transformationProfileRepository = $transformationProfileRepository;
        $this->boardFactory = $boardFactory;
        $this->idFactory = $idFactory;
    }

    /**
     * @throws \Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype
     * @throws \Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard
     * @throws \Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange
     */
    public function handle(Command $command): void
    {
        $board = $this->boardRepository->getBoardByUuid($command->getBoardUuid());
        $transformation = $this->transformationProfileRepository->getByName($board->getProfileName());

        $prototype = $board->transform($command->getKey(), $transformation);
        $board = $this->boardFactory->build($this->idFactory, $prototype);

        $this->boardRepository->addBoard($board);
    }
}
