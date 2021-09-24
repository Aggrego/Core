<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Aggrego\Application\UseCases\CreateBoard\Command;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Component\BoardComponent\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Command\Id;
use Aggrego\Infrastructure\Command\Payload;
use Aggrego\Infrastructure\Command\Sender;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class CreateBoardCommand implements Command
{
    private $profileName;

    private $profileVersion;

    private $key;

    public function __construct(string $profileName, string $profileVersion, array $key)
    {
        $this->profileName = $profileName;
        $this->profileVersion = $profileVersion;
        $this->key = $key;
    }

    public function getKey(): KeyChange
    {
        return new KeyChange($this->key);
    }

    public function getPayload(): Payload
    {
        return new class([]) extends ArrayValueObject implements Payload {
            protected function guard(array $value): void
            {
            }
        };
    }

    public function getProfile(): ProfileName
    {
        return ProfileName::createFromParts($this->profileName, $this->profileVersion);
    }

    public function getId(): Id
    {
        return new class('1') extends StringValueObject implements Id {
            protected function guard(string $value): void
            {
            }
        };
    }

    public function getSender(): Sender
    {
        return new class('test') extends StringValueObject implements Sender {
            protected function guard(string $value): void
            {
            }
        };
    }
}
