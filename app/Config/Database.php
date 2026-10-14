<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'          => 'gdb:mysql://avnadmin:AVNS_a7Zm7HChT9NX1DHCy5K@mysql-2c6924c7-fit-4e4b.c.aivencloud.com:16113/defaultdb?sslmode=verify-ca',
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

        // 1. Check if environment variables exist
        $host = getenv('database.default.hostname') ?: $_ENV['database.default.hostname'] ?? null;
        $user = getenv('database.default.username') ?: $_ENV['database.default.username'] ?? null;
        $pass = getenv('database.default.password') ?: $_ENV['database.default.password'] ?? null;
        $db   = getenv('database.default.database') ?: $_ENV['database.default.database'] ?? null;
        $port = getenv('database.default.port')     ?: $_ENV['database.default.port']     ?? null;

        if ($host) $this->default['hostname'] = trim($host);
        if ($user) $this->default['username'] = trim($user);
        if ($pass) $this->default['password'] = trim($pass);
        if ($db)   $this->default['database'] = trim($db);
        if ($port) $this->default['port']     = (int) trim($port);

        // 2. Clear DSN string if overrides exist
        if ($host || $user || $pass || $db) {
            $this->default['DSN'] = '';
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
