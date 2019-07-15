<?php
require __DIR__ . '/../vendor/autoload.php';

$adapterQueryString = $_GET['adapter'];

if ($adapterQueryString === 'redis') {
    define('REDIS_HOST', isset($_SERVER['REDIS_HOST']) ? $_SERVER['REDIS_HOST'] : '127.0.0.1');

    $adapter = new Prometheus\Storage\Redis(array('host' => REDIS_HOST));
} elseif ($adapterQueryString === 'apc') {
    $adapter = new Prometheus\Storage\APC();
} elseif ($adapterQueryString === 'in-memory') {
    $adapter = new Prometheus\Storage\InMemory();
} else {
    throw new RuntimeException('Adapter not found');
}

if ($adapter) {
    $adapter->flush();
}

