<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

function swoole_exec(string $command, &$output = null, &$returnVar = null)
{
    $result = Swoole\Coroutine::exec($command);
    if ($result) {
        $outputList = explode(PHP_EOL, $result['output']);
        foreach ($outputList as &$value) {
            $value = rtrim($value);
        }
        if (($endLine = end($outputList)) === '') {
            array_pop($outputList);
            $endLine = end($outputList);
        }
        if ($output) {
            $output = array_merge($output, $outputList);
        } else {
            $output = $outputList;
        }
        $returnVar = $result['code'];
        return $endLine;
    }
    return false;
}

function swoole_shell_exec(string $cmd)
{
    $result = Swoole\Coroutine::exec($cmd);
    if ($result && $result['output'] !== '') {
        return $result['output'];
    }
    return null;
}
