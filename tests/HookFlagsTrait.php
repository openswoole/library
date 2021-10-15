<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\Tests;

use Swoole\Runtime;

trait HookFlagsTrait
{
    protected static $flags;

    public static function setHookFlags(int $flags = SWOOLE_HOOK_ALL): void
    {
        Runtime::setHookFlags($flags);
    }

    public static function saveHookFlags(): void
    {
        self::$flags = Runtime::getHookFlags();
    }

    public static function restoreHookFlags(): void
    {
        self::setHookFlags(self::$flags);
    }
}
