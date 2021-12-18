<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\Server;

use Swoole\Server;

class Helper
{
    public const GLOBAL_OPTIONS = [
        'debug_mode' => true,
        'trace_flags' => true,
        'log_file' => true,
        'log_level' => true,
        'log_date_format' => true,
        'log_date_with_microseconds' => true,
        'log_rotation' => true,
        'display_errors' => true,
        'dns_server' => true,
        'socket_dns_timeout' => true,
        'socket_connect_timeout' => true,
        'socket_write_timeout' => true,
        'socket_send_timeout' => true,
        'socket_read_timeout' => true,
        'socket_recv_timeout' => true,
        'socket_buffer_size' => true,
        'socket_timeout' => true,
    ];

    public const SERVER_OPTIONS = [
        'chroot' => true,
        'user' => true,
        'group' => true,
        'daemonize' => true,
        'pid_file' => true,
        'reactor_num' => true,
        'single_thread' => true,
        'worker_num' => true,
        'max_wait_time' => true,
        'max_queued_bytes' => true,
        'enable_coroutine' => true,
        'max_coro_num' => true,
        'max_coroutine' => true,
        'hook_flags' => true,
        'send_timeout' => true,
        'dispatch_mode' => true,
        'send_yield' => true,
        'dispatch_func' => true,
        'discard_timeout_request' => true,
        'enable_unsafe_event' => true,
        'enable_delay_receive' => true,
        'enable_reuse_port' => true,
        'task_use_object' => true,
        'task_object' => true,
        'event_object' => true,
        'task_enable_coroutine' => true,
        'task_worker_num' => true,
        'task_ipc_mode' => true,
        'task_tmpdir' => true,
        'task_max_request' => true,
        'task_max_request_grace' => true,
        'max_connection' => true,
        'max_conn' => true,
        'start_session_id' => true,
        'heartbeat_check_interval' => true,
        'heartbeat_idle_time' => true,
        'max_request' => true,
        'max_request_grace' => true,
        'max_request_execution_time' => true,
        'reload_async' => true,
        'open_cpu_affinity' => true,
        'cpu_affinity_ignore' => true,
        'http_parse_cookie' => true,
        'http_parse_post' => true,
        'http_parse_files' => true,
        'http_compression' => true,
        'http_compression_level' => true,
        'compression_min_length' => true,
        'http_gzip_level' => true,
        'websocket_compression' => true,
        'upload_tmp_dir' => true,
        'enable_static_handler' => true,
        'document_root' => true,
        'http_autoindex' => true,
        'http_index_files' => true,
        'static_handler_locations' => true,
        'input_buffer_size' => true,
        'buffer_input_size' => true,
        'output_buffer_size' => true,
        'buffer_output_size' => true,
        'message_queue_key' => true,
    ];

    public const PORT_OPTIONS = [
        'ssl_cert_file' => true,
        'ssl_key_file' => true,
        'backlog' => true,
        'socket_buffer_size' => true,
        'kernel_socket_recv_buffer_size' => true,
        'kernel_socket_send_buffer_size' => true,
        'buffer_high_watermark' => true,
        'buffer_low_watermark' => true,
        'open_tcp_nodelay' => true,
        'tcp_defer_accept' => true,
        'open_tcp_keepalive' => true,
        'open_eof_check' => true,
        'open_eof_split' => true,
        'package_eof' => true,
        'open_http_protocol' => true,
        'open_websocket_protocol' => true,
        'websocket_subprotocol' => true,
        'open_websocket_close_frame' => true,
        'open_websocket_ping_frame' => true,
        'open_websocket_pong_frame' => true,
        'open_http2_protocol' => true,
        'open_mqtt_protocol' => true,
        'open_redis_protocol' => true,
        'max_idle_time' => true,
        'tcp_keepidle' => true,
        'tcp_keepinterval' => true,
        'tcp_keepcount' => true,
        'tcp_user_timeout' => true,
        'tcp_fastopen' => true,
        'open_length_check' => true,
        'package_length_type' => true,
        'package_length_offset' => true,
        'package_body_offset' => true,
        'package_body_start' => true,
        'package_length_func' => true,
        'package_max_length' => true,
        'ssl_compress' => true,
        'ssl_protocols' => true,
        'ssl_verify_peer' => true,
        'ssl_allow_self_signed' => true,
        'ssl_client_cert_file' => true,
        'ssl_verify_depth' => true,
        'ssl_prefer_server_ciphers' => true,
        'ssl_ciphers' => true,
        'ssl_ecdh_curve' => true,
        'ssl_dhparam' => true,
        'ssl_sni_certs' => true,
    ];

    public static function checkOptions(array $input_options)
    {
        $const_options = self::GLOBAL_OPTIONS + self::SERVER_OPTIONS + self::PORT_OPTIONS;

        foreach ($input_options as $k => $v) {
            if (!array_key_exists(strtolower($k), $const_options)) {
                //TODO throw exception
                trigger_error("Unknown option [{$k}]", E_USER_WARNING);
                debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            }
        }
    }

    public static function onWorkerStart(Server $server, int $workerId)
    {
    }

    public static function onWorkerExit(Server $server, int $workerId)
    {
    }

    public static function onWorkerStop(Server $server, int $workerId)
    {
    }

    public static function statsToJSON(array $stats)
    {
        return json_encode($stats, \JSON_PRETTY_PRINT);
    }

    public static function statsToOpenMetrics(array $stats)
    {
        $event_workers = '';
        foreach ($stats['event_workers'] as $stat) {
            $event_workers .= "# TYPE openswoole_event_workers_start_time counter\n";
            $event_workers .= "openswoole_event_workers_start_time{worker_id={$stat['worker_id']}} ${stat['start_time']}\n";
            $event_workers .= "# TYPE openswoole_event_workers_start_time_seconds counter\n";
            $event_workers .= "openswoole_event_workers_start_time_seconds{worker_id={$stat['worker_id']}} ${stat['start_time_seconds']}\n";
            $event_workers .= "# TYPE openswoole_event_workers_dispatch_count counter\n";
            $event_workers .= "openswoole_event_workers_dispatch_count{worker_id={$stat['worker_id']}} ${stat['dispatch_count']}\n";
            $event_workers .= "# TYPE openswoole_event_workers_request_count counter\n";
            $event_workers .= "openswoole_event_workers_request_count{worker_id={$stat['worker_id']}} ${stat['request_count']}\n";
        }

        $task_workers = '';
        foreach ($stats['task_workers'] as $stat) {
            $task_workers .= "# TYPE openswoole_task_workers_start_time counter\n";
            $task_workers .= "openswoole_task_workers_start_time{worker_id={$stat['worker_id']}} ${stat['start_time']}\n";
            $task_workers .= "# TYPE openswoole_task_workers_start_time_seconds counter\n";
            $task_workers .= "openswoole_task_workers_start_time_seconds{worker_id={$stat['worker_id']}} ${stat['start_time_seconds']}\n";
        }

        $user_workers = '';
        foreach ($stats['user_workers'] as $stat) {
            $user_workers .= "# TYPE openswoole_user_workers_start_time counter\n";
            $user_workers .= "openswoole_user_workers_start_time{worker_id={$stat['worker_id']}} ${stat['start_time']}\n";
            $user_workers .= "# TYPE openswoole_user_workers_start_time_seconds counter\n";
            $user_workers .= "openswoole_user_workers_start_time_seconds{worker_id={$stat['worker_id']}} ${stat['start_time_seconds']}\n";
        }

        return "# HELP openswoole_up Is OpenSwoole server up?\n"
                . "# TYPE openswoole_up gauge\n"
                . "openswoole_up ${stats['up']}\n"
                . "# TYPE openswoole_version info\n"
                . "openswoole_version{version={$stats['version']}} 1\n"
                . "# TYPE openswoole_start_time_seconds counter\n"
                . "openswoole_reactor_threads_num ${stats['reactor_threads_num']}\n"
                . "# TYPE openswoole_reactor_num gauge\n"
                . "openswoole_requests_total ${stats['requests_total']}\n"
                . "# TYPE openswoole_requests_total counter\n"
                . "openswoole_start_time ${stats['start_time']}\n"
                . "# TYPE openswoole_start_time counter\n"
                . "openswoole_max_conn ${stats['max_conn']}\n"
                . "# TYPE openswoole_max_conn gauge\n"
                . "openswoole_coroutine_num ${stats['coroutine_num']}\n"
                . "# TYPE openswoole_coroutine_num gauge\n"
                . "openswoole_start_time_seconds ${stats['start_time_seconds']}\n"
                . "# TYPE openswoole_workers_total gauge\n"
                . "openswoole_workers_total ${stats['workers_total']}\n"
                . "# TYPE openswoole_workers_idle gauge\n"
                . "openswoole_workers_idle ${stats['workers_idle']}\n"
                . "# TYPE openswoole_task_workers_total gauge\n"
                . "openswoole_task_workers_total ${stats['task_workers_total']}\n"
                . "# TYPE openswoole_task_workers_idle gauge\n"
                . "openswoole_task_workers_idle ${stats['task_workers_idle']}\n"
                . "# TYPE openswoole_user_workers_total gauge\n"
                . "openswoole_user_workers_total ${stats['user_workers_total']}\n"
                . "# TYPE openswoole_dispatch_total gauge\n"
                . "openswoole_dispatch_total ${stats['dispatch_total']}\n"
                . "# TYPE openswoole_connections_accepted counter\n"
                . "openswoole_connections_accepted ${stats['connections_accepted']}\n"
                . "# TYPE openswoole_connections_active gauge\n"
                . "openswoole_connections_active ${stats['connections_active']}\n"
                . "# TYPE openswoole_connections_closed gauge\n"
                . "openswoole_connections_closed ${stats['connections_closed']}\n"
                . "# TYPE openswoole_reload_count counter\n"
                . "openswoole_reload_count ${stats['reload_count']}\n"
                . "# TYPE openswoole_reload_last_time gauge\n"
                . "openswoole_reload_last_time ${stats['reload_last_time']}\n"
                . "# TYPE openswoole_worker_vm_object_num gauge\n"
                . "openswoole_worker_vm_object_num ${stats['worker_vm_object_num']}\n"
                . "# TYPE openswoole_worker_vm_resource_num gauge\n"
                . "openswoole_worker_vm_resource_num ${stats['worker_vm_resource_num']}\n"
                . "# TYPE openswoole_worker_memory_usage gauge\n"
                . "openswoole_worker_memory_usage ${stats['worker_memory_usage']}\n{$event_workers}{$task_workers}{$user_workers}";
    }
}
