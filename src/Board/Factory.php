<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Builder as BoardBuilder;
use Aggrego\Domain\Board\Exception\UnsupportedPrototypeBuilderException;
use Aggrego\Domain\Profile\BoardConstruction\Factory as BoardConstructionFactory;
use Aggrego\Domain\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class Factory
{
    /** @var BoardBuilder[] */
    private $builders;

    /** @var BoardTransformationFactory */
    private $transformationFactory;

    /** @var BoardConstructionFactory */
    private $boardConstructionFactory;

    public function __construct(
        array $builders,
        BoardTransformationFactory $transformationFactory,
        BoardConstructionFactory $boardConstructionFactory
    )
    {
        Assertion::allIsInstanceOf($builders, BoardBuilder::class);
        $this->builders = $builders;
        $this->transformationFactory = $transformationFactory;
        $this->boardConstructionFactory = $boardConstructionFactory;
    }

    public function newBoard(Key $key, Profile $profile): Board
    {
        $factory = $this->boardConstructionFactory->factory($profile);
        $prototype = $factory->build($key);
        $key = $prototype->getKey();
        $profile = $prototype->getProfile();

        $uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile
            )->toString()
        );

        foreach ($this->builders as $builder) {
            if ($builder->isSupported($prototype)) {
                continue;
            }

            return $builder->build(
                $uuid,
                $prototype->getKey(),
                $prototype->getProfile(),
                $prototype->getMetadata(),
                null
            );
        }

        throw new UnsupportedPrototypeBuilderException();
    }

    public function fromBoard(Board $board): Board
    {
        $transformation = $this->transformationFactory->factory($board->getProfile());
        $prototype = $transformation->transform($board);

        $key = $prototype->getKey();
        $profile = $prototype->getProfile();

        $parentUuid = $board->getUuid();
        $uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key->getValue()) . $profile . $parentUuid->getValue()
            )->toString()
        );

        foreach ($this->builders as $builder) {
            if (!$builder->isSupported($prototype)) {
                continue;
            }

            return $builder->build(
                $uuid,
                $prototype->getKey(),
                $prototype->getProfile(),
                $prototype->getMetadata(),
                $parentUuid
            );
        }

        throw new UnsupportedPrototypeBuilderException();
    }
}
