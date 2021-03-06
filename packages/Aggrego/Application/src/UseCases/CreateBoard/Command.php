<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\UseCases\CreateBoard;

use Aggrego\Domain\Profile\KeyChange;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Command\Command as InfrastructureCommand;

interface Command extends InfrastructureCommand
{
    public function getKey(): KeyChange;

    public function getProfile(): ProfileName;
}
