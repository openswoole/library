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

Coroutine::set([
    'log_level' => SWOOLE_LOG_INFO,
    'trace_flags' => 0,
]);

if (!defined('SWOOLE_LIBRARY')) {
    require __DIR__ . '/../vendor/autoload.php';
}

if (!defined('MYSQL_SERVER_HOST')) {
    define('MYSQL_SERVER_HOST', 'mysql');
    define('MYSQL_SERVER_PORT', 3306);
    define('MYSQL_SERVER_USER', 'root');
    define('MYSQL_SERVER_PWD', 'password');
    define('MYSQL_SERVER_DB', 'test');
}

if (!defined('REDIS_SERVER_HOST')) {
    define('REDIS_SERVER_HOST', 'redis');
    define('REDIS_SERVER_PORT', 6379);
}
