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

namespace Aggrego\Application\Api\Command\CreateBoard;

use Aggrego\Application\Board\BoardRepository;
use Aggrego\Application\Profile\Building\BuildingProfileRepository;
use Aggrego\Domain\Board\Factory\BoardFactory;
use Aggrego\Domain\Board\Id\IdFactory;

class UseCase
{
    private $boardRepository;

    private $buildingProfileRepository;

    private $boardBuilder;

    private $idFactory;

    public function __construct(
        BoardRepository $boardRepository,
        BuildingProfileRepository $buildingProfileRepository,
        BoardFactory $boardBuilder,
        IdFactory $idFactory
    )
    {
        $this->boardRepository = $boardRepository;
        $this->buildingProfileRepository = $buildingProfileRepository;
        $this->boardBuilder = $boardBuilder;
        $this->idFactory = $idFactory;
    }

    /**
     * @throws \Aggrego\Domain\Board\Factory\Exception\UnprocessablePrototype
     * @throws \Aggrego\Domain\Profile\Building\Exception\UnprocessableKeyChange
     */
    public function handle(Command $command): void
    {
        $profile = $this->buildingProfileRepository->getByName($command->getProfile());
        $prototype = $profile->buildBoard($command->getKey());

        $board = $this->boardBuilder->build($this->idFactory, $prototype);
        $this->boardRepository->addBoard($board);
    }
}
