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
use Aggrego\Domain\Profile\BoardConstruction\Factory as BoardConstructionFactory;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Ramsey\Uuid\Uuid as RamseyUuid;

class NewBoardFactory
{
    /**
     * @var BoardBuilder[]
     */
    private $builders;

    /**
     * @var BoardConstructionFactory
     */
    private $boardConstructionFactory;

    public function __construct(
        array $builders,
        BoardConstructionFactory $boardConstructionFactory
    ) {
        Assertion::allIsInstanceOf($builders, BoardBuilder::class);
        $this->builders = $builders;
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
            if (!$builder->isSupported($prototype)) {
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
}
