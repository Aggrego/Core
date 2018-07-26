<?php

namespace Aggrego\Domain\Api\Query\GetUnit;

use Aggrego\Domain\Model\Unit\Repository;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Name;
use Aggrego\Domain\ValueObject\Profile;
use Aggrego\Domain\ValueObject\Version;

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
        $key = new Key($query->getKey());
        $profile = new Profile(
            new Name($query->getProfileName()),
            new Version($query->getVersionNumber())
        );

        $unit = $this->repository->findUnit($key, $profile);
        if (!is_null($unit)) {
            return Response::createValidResponse($unit);
        } else {
            return Response::createInvalidResponse($query);
        }
    }
}
