<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

define('SWOOLE_LIBRARY', true);

!defined('CURLOPT_HEADEROPT') && define('CURLOPT_HEADEROPT', 229);
!defined('CURLOPT_PROXYHEADER') && define('CURLOPT_PROXYHEADER', 10228);
!defined('CURLOPT_RESOLVE') && define('CURLOPT_RESOLVE', 10203);
