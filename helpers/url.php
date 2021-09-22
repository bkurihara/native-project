<?php

use Jenssegers\Blade\Blade;

function getURISegment()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return explode('/', $uri_path, 3)[2] ?? null;
}

function auth_session_mode()
{
    return $_ENV['AUTH_SESSION_MODE'];
}

function base_url($url = null)
{
    if ($url)
        return $_ENV['BASE_URL'] . $url;
    else
        return $_ENV['BASE_URL'];
}

function relative_base_url($url = null)
{
    if ($url)
        return $_ENV['RELATIVE_BASE_URL'] . $url;
    else
        return $_ENV['RELATIVE_BASE_URL'];
}

function redirect($url)
{
    header('Location: ' . $url);
}

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function csrf_field()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return "<input type='hidden' name='csrf_token' value='{$_SESSION['csrf_token']}'>";
}

function checkCSRFtoken()
{
    if ((!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']))
        || (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))) {

        $blade = new Blade('views', 'cache');
        echo $blade->render('errors.405');
        die();

    }
}