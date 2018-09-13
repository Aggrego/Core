<?php

declare(strict_types = 1);

namespace Tests\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\Profile\BoardTransformation\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Board\Shard\FinalItem;
use Aggrego\Domain\Board\Step\Step;
use Aggrego\Domain\Board\Step\Steps\FinalStep;
use Aggrego\Domain\Board\Step\Steps\ProgressStep;
use Aggrego\Domain\Shared\ValueObject\Data;
use Tests\Profile\BaseTestWatchman;

class Watchman extends BaseTestWatchman implements DomainWatchman
{
    public function passTransformation(Profile $profile): Transformation
    {
        return new class extends BaseTestWatchman implements Transformation
        {
            public function transform(ProgressStep $step): Step
            {
                $data = '';
                /** @var FinalItem $item */
                foreach ($step->getShards() as $item) {
                    $data .= $item->getData()->getValue() . ' ';
                }
                return new FinalStep(new Data($data));
            }
        };
    }
}
