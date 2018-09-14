<?php

declare(strict_types = 1);

namespace Aggrego\DataBoard\Board;

use Aggrego\Domain\Board\Metadata as DomainMetadata;

class Metadata implements DomainMetadata
{
    /** @var Data */
    private $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
