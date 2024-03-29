<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

use Swoole\Coroutine;

use function Swoole\Coroutine\map;

require __DIR__ . '/../bootstrap.php';

Coroutine::set(['hook_flags' => SWOOLE_HOOK_ALL]);

function fatorial(int $n): int
{
    return array_product(range($n, 1));
}

Coroutine\run(function () {
    $use = microtime(true);

    $results = map([2, 3, 4], 'fatorial'); // 2 6 24

    $use = microtime(true) - $use;
    echo "Use {$use}s, Result:\n";
    var_dump($results);
});
echo "Done\n";
