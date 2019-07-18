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
use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Uuid;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;

class Command implements ConsumerCommand
{
    public const NAME = 'Aggrego/Domain/CreateBoard';

    /**
     * @var Uuid
     */
    private $uuid;

    /**
     * @var Key
     */
    private $key;

    /**
     * @var Profile
     */
    private $profile;

    public function __construct(string $uuid, array $key, string $profileName, string $versionNumber)
    {
        $this->uuid = new Uuid($uuid);
        $this->key = new Key($key);
        $this->profile = Profile::createFromParts($profileName, $versionNumber);
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getName(): Name
    {
        return new Name(self::NAME);
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function serialize()
    {
        return json_encode([
            'uuid' => $this->getUuid()->getValue(),
            'name' => $this->getName()->getValue(),
            'key' => $this->key->getValue(),
            'profile_name' => $this->profile->getName(),
            'profile_version' => $this->profile->getVersion()
        ]);
    }

    public function unserialize($serialized): self
    {
        $json = json_decode($serialized, true);
        Assertion::keyExists($json, 'uuid');
        Assertion::keyExists($json, 'name');
        Assertion::eq($json['name'], self::NAME);
        Assertion::keyExists($json, 'key');
        Assertion::keyExists($json, 'profile_name');
        Assertion::keyExists($json, 'profile_version');

        $this->uuid = new Uuid($json['uuid']);
        $this->key = new Key($json['key']);
        $this->profile = Profile::createFromParts($json['profile_name'], $json['profile_version']);

        return $this;
    }
}
