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
use Swoole\Coroutine\FastCGI\Client;

require __DIR__ . '/../../bootstrap.php';

Coroutine\run(function () {
    try {
        $result = Client::call(
            'php-fpm:9000',
            __DIR__ . '/greeter.php',
            ['who' => 'Swoole']
        );
        echo "Result: {$result}\n";
    } catch (Client\Exception $exception) {
        echo "Error: {$exception->getMessage()}\n";
    }
});
