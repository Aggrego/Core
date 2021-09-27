<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Contract\Application\UseCases\TransformBoard;

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id as BoardId;
use Aggrego\Component\BoardComponent\Domain\Profile\KeyChange;
use Aggrego\Infrastructure\Command\Command as InfrastructureCommand;

interface TransformBoardCommand extends InfrastructureCommand
{
    public function getBoardId(): BoardId;

    public function getKey(): KeyChange;
}
