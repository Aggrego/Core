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

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\Domain\Board\NewBoardFactory;
use Aggrego\Domain\Board\Repository;

class UseCase
{
    /** @var Repository */
    private $repository;

    /** @var NewBoardFactory */
    private $factory;

    public function __construct(Repository $repository, NewBoardFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     * @return Result
     */
    public function handle(Command $command): Result
    {
        $board = $this->factory->newBoard($command->getKey(), $command->getProfile());
        $this->repository->addBoard($board);

        return Result::ok($board);
    }
}
