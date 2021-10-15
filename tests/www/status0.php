<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

header('HTTP/1.0 200 OK');
header('Status: 400 Bad Request'); // HTTP status overridden with reason phase included.

echo "Hello world!\n";
