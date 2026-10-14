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

        // Override from environment if present
        if (getenv('database.default.hostname')) {
            $this->default['hostname'] = getenv('database.default.hostname');
        }
        if (getenv('database.default.database')) {
            $this->default['database'] = getenv('database.default.database');
        }
        if (getenv('database.default.username')) {
            $this->default['username'] = getenv('database.default.username');
        }
        if (getenv('database.default.password')) {
            $this->default['password'] = getenv('database.default.password');
        }
        if (getenv('database.default.port')) {
            $this->default['port'] = (int) getenv('database.default.port');
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
