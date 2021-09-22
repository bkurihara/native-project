<?php
//session_cache_limiter("private_no_expire");

session_start();
//header("Cache-Control: no cache");
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once __DIR__.'/app/databases/connect.php';
include_once __DIR__ . '/helpers/url.php';
include_once __DIR__ . '/routes/web.php';

