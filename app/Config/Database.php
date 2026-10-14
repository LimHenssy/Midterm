<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * The default database group to use if none is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection setup for Render & Aiven MySQL.
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => '',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => true, // Required for Aiven SSL connections
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * This database group is used for system testing.
     */
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

        // Dynamically assign connection settings from environment variables
        if (env('database.default.hostname')) {
            $this->default['hostname'] = env('database.default.hostname');
        }
        if (env('database.default.database')) {
            $this->default['database'] = env('database.default.database');
        }
        if (env('database.default.username')) {
            $this->default['username'] = env('database.default.username');
        }
        if (env('database.default.password')) {
            $this->default['password'] = env('database.default.password');
        }
        if (env('database.default.port')) {
            $this->default['port'] = (int) env('database.default.port');
        }
        if (env('database.default.DBDriver')) {
            $this->default['DBDriver'] = env('database.default.DBDriver');
        }

        // Ensure tests group runs in testing environment
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
