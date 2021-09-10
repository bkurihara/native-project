<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include_once __DIR__ . '/helpers/url.php';
include_once __DIR__ . '/routes/web.php';

