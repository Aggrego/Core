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

namespace Aggrego\DataDomainBoard\Board\Prototype;

use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\Domain\Board\Prototype\Metadata as DomainMetadata;

class Metadata implements DomainMetadata
{
    /** @var Data */
    private $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
