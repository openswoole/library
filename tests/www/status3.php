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
header('Status:  403  '); // HTTP status overridden with extra spaces included, but no reason phrase.

echo "Hello world!\n";
