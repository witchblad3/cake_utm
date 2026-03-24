<?php
class DATABASE_CONFIG {

    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'db',
        'login' => 'cake',
        'password' => 'cake',
        'database' => 'utm_test',
        'prefix' => '',
        'encoding' => 'utf8'
    );

    public function __construct() {
        $this->default['host'] = getenv('DB_HOST') ? getenv('DB_HOST') : 'db';
        $this->default['login'] = getenv('DB_USER') ? getenv('DB_USER') : 'cake';
        $this->default['password'] = getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'cake';
        $this->default['database'] = getenv('DB_NAME') ? getenv('DB_NAME') : 'utm_test';
        $this->default['port'] = getenv('DB_PORT') ? getenv('DB_PORT') : '3306';
    }
}
