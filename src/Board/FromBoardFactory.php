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

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Builder as BoardBuilder;
use Aggrego\Domain\Board\Exception\UnsupportedPrototypeBuilderException;
use Aggrego\Domain\Profile\BoardTransformation\Factory as BoardTransformationFactory;
use Assert\Assertion;
use Ramsey\Uuid\Uuid as RamseyUuid;

class FromBoardFactory
{
    /**
     * @var BoardBuilder[]
     */
    private $builders;

    /**
     * @var BoardTransformationFactory
     */
    private $transformationFactory;

    public function __construct(
        array $builders,
        BoardTransformationFactory $transformationFactory
    ) {
        Assertion::allIsInstanceOf($builders, BoardBuilder::class);
        $this->builders = $builders;
        $this->transformationFactory = $transformationFactory;
    }

    public function fromBoard(Key $key, Board $board): Board
    {
        $transformation = $this->transformationFactory->factory($board->getProfile());
        $prototype = $transformation->transform($key, $board);

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
