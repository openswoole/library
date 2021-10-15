<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

$table = swoole_table(100, 'a:f, b:i, c: s:600, d : f');
var_dump($table);

$table = swoole_table(100, 'a: float, b: int, c: string:600, d : float');
var_dump($table);
