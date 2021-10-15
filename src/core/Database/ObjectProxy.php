<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\Database;

use Error;

class ObjectProxy extends \Swoole\ObjectProxy
{
    public function __clone()
    {
        throw new Error('Trying to clone an uncloneable database proxy object');
    }
}
