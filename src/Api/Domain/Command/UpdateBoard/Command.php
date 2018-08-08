<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Domain\Command\UpdateBoard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class Command
{
    /** @var Uuid */
    private $boardUuid;

    /** @var Uuid */
    private $shardUuid;

    /** @var Profile */
    private $profile;

    /** @var Data */
    private $data;

    public function __construct(
        string $boardUuid,
        string $shardUuid,
        string $profileName,
        string $versionName,
        string $data
    )
    {
        $this->boardUuid = new Uuid($boardUuid);
        $this->shardUuid = new Uuid($shardUuid);
        $this->profile = Profile::createFrom($profileName, $versionName);
        $this->data = new Data($data);
    }

    public function getBoardUuid(): Uuid
    {
        return $this->boardUuid;
    }

    public function getShardUuid(): Uuid
    {
        return $this->shardUuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
