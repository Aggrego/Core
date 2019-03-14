<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Api\Command\TransformBoard\Exception\InvalidCommandDataException;
use Aggrego\Domain\Board\FromBoardFactory;
use Aggrego\Domain\Board\Repository;

class UseCase
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var FromBoardFactory
     */
    private $factory;

    public function __construct(Repository $repository, FromBoardFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param  Command $command
     * @throws InvalidCommandDataException
     */
    public function handle(Command $command): void
    {
        $board = $this->repository->getBoardByUuid($command->getBoardUuid());
        $newBoard = $this->factory->fromBoard($command->getKey(), $board);
        $this->repository->addBoard($newBoard);
    }
}
