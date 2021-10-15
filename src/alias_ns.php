<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Co;

use Swoole\Coroutine;

if (SWOOLE_USE_SHORTNAME) {
    function run(callable $fn, ...$args)
    {
        return \Swoole\Coroutine\run($fn, ...$args);
    }

    function go(callable $fn, ...$args)
    {
        return Coroutine::create($fn, ...$args);
    }

    function defer(callable $fn)
    {
        Coroutine::defer($fn);
    }
}
