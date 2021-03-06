<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\Coroutine\Server;

use Swoole\Coroutine\Socket;

class Connection
{
    protected $socket;

    public function __construct(Socket $conn)
    {
        $this->socket = $conn;
    }

    public function recv(float $timeout = 0)
    {
        return $this->socket->recvPacket($timeout);
    }

    public function send(string $data)
    {
        return $this->socket->sendAll($data);
    }

    public function close(): bool
    {
        return $this->socket->close();
    }

    public function exportSocket(): Socket
    {
        return $this->socket;
    }
}
