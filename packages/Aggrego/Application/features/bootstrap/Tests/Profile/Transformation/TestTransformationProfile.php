<?php

declare(strict_types = 1);

namespace Tests\Profile\Transformation;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\BoardPrototype\Metadata;
use Aggrego\Domain\BoardPrototype\Name as PrototypeName;
use Aggrego\Domain\BoardPrototype\Prototype;
use Aggrego\Domain\BoardPrototype\Exception\InvalidName;
use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Domain\Profile\Transformation\TransformationProfile;
use Tests\BoardPrototype\TestPrototype;

class TestTransformationProfile implements TransformationProfile
{
    public const NAME = 'test_profile:1.0';

    public function getName(): Name
    {
        return Name::createFromName(self::NAME);
    }

    /**
     * @throws UnprocessableBoard
     * @throws UnprocessableKeyChange
     * @throws InvalidName
     */
    public function transform(KeyChange $change, Board $board): Prototype
    {
        $changeValue = $change->getValue();

        if (!$board->getProfileName()->equal($this->getName())) {
            throw new UnprocessableBoard();
        }

        if (!isset($changeValue['key'])) {
            throw new UnprocessableKeyChange();
        }
        $prototype = new TestPrototype(
            new PrototypeName('test'),
            $this->getName(),
            new Metadata(['key' => $changeValue['key']]),
            null
        );

        return $prototype;
    }
}
