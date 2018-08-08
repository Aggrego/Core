<?php

declare(strict_types = 1);

namespace Tests\Profile\BoardTransformation;

use Tests\Profile\BaseTestSupport;
use Aggrego\Domain\Model\ProgressBoard\Entity\FinalItem;
use Aggrego\Domain\Model\ProgressBoard\ValueObject\Collection;
use Aggrego\Domain\Profile\BoardTransformation\Transformation as DomainTransformation;
use Aggrego\Domain\ValueObject\Data;

class Transformation extends BaseTestSupport implements DomainTransformation
{
    public function process(Collection $shards): Data
    {
        $data = '';
        /** @var FinalItem $shard */
        foreach ($shards as $shard) {
            $data .= $shard->getData()->getValue() . ' ';
        }
        return new Data($data);
    }
}
