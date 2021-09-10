<?php
function getURISegment()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return explode('/', $uri_path,3)[2] ?? null;
}

function base_url($url = null)
{
    if ($url)
        return $_ENV['BASE_URL'] . $url;
    else
        return $_ENV['BASE_URL'];
}