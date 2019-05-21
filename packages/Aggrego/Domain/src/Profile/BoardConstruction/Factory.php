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

namespace Aggrego\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Profile\BoardConstruction\Exception\BuilderNotFoundException;
use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;

class Factory
{
    /**
     * @var Watchman[]
     */
    private $watchmen;

    public function __construct(array $watchmen)
    {
        Assertion::allImplementsInterface($watchmen, Watchman::class);
        $this->watchmen = $watchmen;
    }

    public function factory(Profile $profile): Builder
    {
        foreach ($this->watchmen as $watchman) {
            if ($watchman->isSupported($profile)) {
                return $watchman->passBuilder($profile);
            }
        }
        throw new BuilderNotFoundException();
    }
}
