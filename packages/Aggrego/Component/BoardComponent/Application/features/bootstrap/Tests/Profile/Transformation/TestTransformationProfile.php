<?php

declare(strict_types=1);

namespace Tests\Profile\Transformation;

use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Exception\InvalidName;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Metadata;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Name as PrototypeName;
use Aggrego\Component\BoardComponent\Domain\BoardPrototype\Prototype;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Name;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableBoard;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\Exception\UnprocessableKeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Transformation\TransformationProfile;
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
        return new TestPrototype(
            new PrototypeName('test'),
            $this->getName(),
            new Metadata(['key' => $changeValue['key']]),
            null
        );
    }
}
