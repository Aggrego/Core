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

namespace Tests\Profile\BoardConstruction;

use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use Aggrego\Domain\Profile\Profile;
use Tests\Board\Prototype\Board;

class Builder implements DomainBuilder
{
    public const DEFAULT_KEY = ['key' => 'init'];

    public const INITIAL_SHARDS_COUNT = 2;

    public const DEFAULT_UUID = 'd0b7e1e2-b95c-5567-817b-bb9b1b9e272e';
    public const DEFAULT_BOARD_UUID = 'd0b7e1e2-b95c-5567-817b-bb9b1b9e272e';
    public const DEFAULT_SHARD_MR_UUID = '50cbb7cb-e51a-5118-b389-057176668991';
    public const DEFAULT_SHARD_MRS_UUID = '4a111770-aedd-519e-84a2-9b4080c1ea1c';

    public const DEFAULT_SOURCE_NAME = 'fake.surname';
    public const DEFAULT_SOURCE_VERSION = '1.0';
    public const DEFAULT_KEY_MR = ['prefix' => 'Mr'];
    public const DEFAULT_KEY_MRS = ['prefix' => 'Mrs'];

    /**
     * @var Profile
     */
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param  Key $key
     * @return BoardPrototype
     * @throws UnableToBuildBoardException
     * @throws \Assert\AssertionFailedException
     */
    public function build(Key $key): BoardPrototype
    {
        if (!isset($key->getValue()['key'])) {
            throw new UnableToBuildBoardException();
        }
        $prototype = new Board($key, $this->profile);

        return $prototype;
    }
}
