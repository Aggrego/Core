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

namespace Aggrego\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Exception\TransformationNotFoundException;
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

    /**
     * @param  Profile $profile
     * @return Transformation
     * @throws TransformationNotFoundException
     */
    public function factory(Profile $profile): Transformation
    {
        foreach ($this->watchmen as $watchman) {
            if ($watchman->isSupported($profile)) {
                return $watchman->passTransformation($profile);
            }
        }
        throw new TransformationNotFoundException();
    }
}
