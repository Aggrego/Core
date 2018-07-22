<?php

namespace TimiTao\Construo\Domain\Query\GetUnit;

use TimiTao\Construo\Domain\Model\Unit\Repository;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Name;
use TimiTao\Construo\Domain\ValueObject\Profile;
use TimiTao\Construo\Domain\ValueObject\Version;

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
