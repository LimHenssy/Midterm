<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'          => '',
        'hostname'     => 'mysql-2c6924c7-fit-4e4b.c.aivencloud.com',
        'username'     => 'avnadmin',
        'password'     => 'AVNS_a7Zm7HChT9NX1DHCy5K',
        'database'     => 'defaultdb',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => true,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 16113,
        'numberNative' => false,
    ];

    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // 1. Force trimmed string inputs from environment variables if present
        $envHost = trim((string) getenv('database.default.hostname'));
        $envUser = trim((string) getenv('database.default.username'));
        $envPass = trim((string) getenv('database.default.password'));
        $envDb   = trim((string) getenv('database.default.database'));
        $envPort = (int) getenv('database.default.port');

        if (!empty($envHost)) {
            $this->default['hostname'] = $envHost;
        }
        if (!empty($envUser)) {
            $this->default['username'] = $envUser;
        }
        if (!empty($envPass)) {
            $this->default['password'] = $envPass;
        }
        if (!empty($envDb)) {
            $this->default['database'] = $envDb;
        }
        if ($envPort > 0) {
            $this->default['port'] = $envPort;
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
