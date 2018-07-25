<?php

namespace TimiTao\Construo\Domain\Api\Command\UpdateBoard;

class Command
{
    /** @var string */
    private $boardUuid;

    /** @var string */
    private $shardUuid;

    /** @var string */
    private $sourceName;

    /** @var string */
    private $versionName;

    /** @var string */
    private $data;

    public function __construct(
        string $boardUuid,
        string $shardUuid,
        string $sourceName,
        string $versionName,
        string $data
    )
    {
        $this->boardUuid = $boardUuid;
        $this->shardUuid = $shardUuid;
        $this->sourceName = $sourceName;
        $this->versionName = $versionName;
        $this->data = $data;
    }

    public function getBoardUuid(): string
    {
        return $this->boardUuid;
    }

    public function getShardUuid(): string
    {
        return $this->shardUuid;
    }

    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    public function getVersionName(): string
    {
        return $this->versionName;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
