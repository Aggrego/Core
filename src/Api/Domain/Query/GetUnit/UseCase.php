<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Query\GetUnit;

use Aggrego\Domain\Api\Application\Model\Unit\Repository;

class UseCase
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Query $query): Response
    {
        $key = $query->getKey();
        $profile = $query->getProfile();

        $unit = $this->repository->findUnit($key, $profile);
        if (!is_null($unit)) {
            return Response::createValidResponse($unit);
        } else {
            return Response::createInvalidResponse($query);
        }
    }
}
