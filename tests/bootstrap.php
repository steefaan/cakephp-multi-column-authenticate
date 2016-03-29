<?php

use Cake\Core\Plugin;

require_once 'vendor/autoload.php';

require 'vendor/cakephp/cakephp/tests/bootstrap.php';

if (!getenv('db_dsn')) {
    putenv('db_dsn=sqlite:///:memory:');
}
if (!getenv('DB')) {
    putenv('DB=sqlite');
}

ConnectionManager::config('test', [
    'url' => getenv('db_dsn')
]);

Plugin::load('MultiColumnAuthenticate', [
    'path' => dirname(dirname(__FILE__)) . DS
]);
