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

namespace Aggrego\CommandConsumer\Query;

use Aggrego\CommandConsumer\Name;
use Aggrego\CommandConsumer\Version;

interface Response
{
    public function getName(): Name;

    public function getVersion(): Version;

    public function getPayload(): array;
}
