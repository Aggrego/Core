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

namespace Aggrego\DataBoard\Board;

use Aggrego\AggregateEventConsumer\Uuid;
use Aggrego\DataBoard\Board\Board as DataBoard;
use Aggrego\DataBoard\Board\Prototype\Board as DataBoardPrototype;
use Aggrego\Domain\Board\Board as DomainBoard;
use Aggrego\Domain\Board\Builder as FactoryInterface;
use Aggrego\Domain\Board\Exception\UnsupportedPrototypeBuilderException;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Metadata as DomainMetadata;
use Aggrego\Domain\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Assert\AssertionFailedException;

class Builder implements FactoryInterface
{
    public function isSupported(PrototypeBoard $board): bool
    {
        return $board instanceof DataBoardPrototype;
    }

    public function build(Uuid $uuid, Key $key, Profile $profile, DomainMetadata $metadata, ?Uuid $parentUuid): DomainBoard
    {
        try {
            Assertion::isInstanceOf($metadata, Metadata::class);
        } catch (AssertionFailedException $e) {
            throw new UnsupportedPrototypeBuilderException($e->getMessage(), $e->getCode(), $e);
        }
        /** @var Metadata $metadata */
        return new DataBoard($uuid, $key, $profile, $metadata, $parentUuid);
    }
}
