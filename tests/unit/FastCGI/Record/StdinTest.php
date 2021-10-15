<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\FastCGI\Record;

use PHPUnit\Framework\TestCase;
use Swoole\FastCGI;

/**
 * @internal
 * @coversNothing
 */
class StdinTest extends TestCase
{
    protected static $rawMessage = '01050001000404007465737400000000';

    public function testPacking(): void
    {
        $request = new Stdin('test');
        $this->assertEquals($request->getContentData(), 'test');
        $this->assertEquals($request->getType(), FastCGI::STDIN);
        $this->assertSame(self::$rawMessage, bin2hex((string) $request));
    }

    public function testUnpacking(): void
    {
        $request = Stdin::unpack(hex2bin(self::$rawMessage));
        $this->assertEquals($request->getType(), FastCGI::STDIN);
        $this->assertEquals($request->getContentData(), 'test');
    }
}
