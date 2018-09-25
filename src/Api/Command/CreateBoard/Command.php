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

use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;

class Command
{
    /** @var Key */
    private $key;

    /** @var Profile Profile */
    private $profile;

    public function __construct(array $key, string $profileName, string $versionNumber)
    {
        $this->key = new Key($key);
        $this->profile = Profile::createFrom($profileName, $versionNumber);
    }

    public function getKey(): Key
    {
        return $this->key;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }
}
