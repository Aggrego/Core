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

namespace Aggrego\Domain\Api\Command\CreateBoard;

use Aggrego\CommandConsumer\Command as ConsumerCommand;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\CommandConsumer\Version;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Command implements ConsumerCommand
{
    /** @var Uuid */
    private $uuid;

    /** @var Key */
    private $key;

    /** @var Profile */
    private $profile;

    public function __construct(array $key, string $profileName, string $versionNumber)
    {
        $this->key = new Key($key);
        $this->profile = Profile::createFromParts($profileName, $versionNumber);
        $this->uuid = new Uuid(
            RamseyUuid::uuid5(
                RamseyUuid::NAMESPACE_DNS,
                serialize($key) . $this->profile
            )->toString()
        );
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getVersion(): Version
    {
        return new Version('1');
    }

    public function getPayload(): array
    {
        return [
            'uuid' => $this->getUuid()->getValue(),
            'version' => $this->getVersion()->getValue(),
            'key' => $this->key->getValue(),
            'profile' => (string)$this->profile,
        ];
    }
}
