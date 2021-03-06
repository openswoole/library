<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\FastCGI;

use PHPUnit\Framework\TestCase;
use Swoole\FastCGI\Record\BeginRequest;
use Swoole\FastCGI\Record\Params;

/**
 * @internal
 * @coversNothing
 */
class FrameParserTest extends TestCase
{
    public function testHasFrame(): void
    {
        $incompletePacket = hex2bin('010100010008000000');
        $this->assertFalse(FrameParser::hasFrame($incompletePacket));

        $completePacket = hex2bin('01010001000800000001010000000000');
        $this->assertTrue(FrameParser::hasFrame($completePacket));
    }

    public function testParsingFrame(): void
    {
        // one FCGI_BEGIN request with two empty FCGI_PARAMS request
        $dataStream = hex2bin('0101000100080000000101000000000001040001000000000104000100000000');
        $bufferSize = strlen($dataStream);
        $this->assertEquals(32, $bufferSize);

        // consume FCGI_BEGIN request
        $record = FrameParser::parseFrame($dataStream);
        $this->assertInstanceOf(BeginRequest::class, $record);
        $recordSize = strlen((string) $record);
        $this->assertEquals(16, $recordSize);

        $this->assertEquals($bufferSize - $recordSize, strlen($dataStream));

        // consume first FCGI_PARAMS request
        $record = FrameParser::parseFrame($dataStream);
        $this->assertInstanceOf(Params::class, $record);

        // consume second FCGI_PARAMS request
        $record = FrameParser::parseFrame($dataStream);
        $this->assertInstanceOf(Params::class, $record);

        $this->assertEquals(0, strlen($dataStream));
    }
}
