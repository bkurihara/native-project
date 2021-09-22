<?php

namespace App\cores;

class Route
{

    private static $routes = array();
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;

    // adding allowed url to routes array
    public static function addGet($url, $class, $function)
    {
        array_push(self::$routes, array(
            'url' => $url,
            'class' => $class,
            'function' => $function,
            'method' => 'get'
        ));
    }

    public static function addPost($url, $class, $function)
    {
        array_push(self::$routes, array(
            'url' => $url,
            'class' => $class,
            'function' => $function,
            'method' => 'post'
        ));
    }

    // handling url / path not found
    public static function pathNotFound($function)
    {
        self::$pathNotFound = $function;
    }

    // handling method not allowed page
    public static function methodNotAllowed($function)
    {
        self::$methodNotAllowed = $function;
    }

    // start looking for the path in the allowed url arrays ($routes)
    public static function run($basepath = '', $case_matters = false)
    {
        // ex : /native-project/// => /native-project
        $basepath = rtrim($basepath, '/');

        // ex : http://domain.com/foo/bar => /foo/bar
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = '/';

        // if path is provided set path equal to provided path
        if (isset($parsed_url['path'])) {
            $path = $parsed_url['path'];
        }

        // Get current request method, ex : GET, POST, etc
        $method = $_SERVER['REQUEST_METHOD'];

        if (isPost()) {
            checkCSRFtoken();
        }

        $path_match_found = false;
        $route_match_found = false;

        // iterate through $routes array and find matching url
        foreach (self::$routes as $route) {

            // If the method matches check the path
            // Add basepath to matching string
            if ($basepath != '' && $basepath != '/') {
                $route['url'] = '(' . $basepath . ')' . $route['url'];
            }

            // prepare regex expression
            $route['url'] = '#^' . $route['url'] . '$#' . ($case_matters ? '' : 'i') . 'u';

            // Check path match
            if (preg_match($route['url'], $path, $matches)) {
                $path_match_found = true;

                // Cast allowed method to array if it's not one already, then run through all methods
                foreach ((array)$route['method'] as $allowedMethod) {
                    // Check method match
                    if (strtolower($method) == strtolower($allowedMethod)) {
                        // $matches = domain.com/test/foo/bar
                        array_shift($matches); // Always remove first element. This contains the whole string

                        if ($basepath != '' && $basepath != '/') {
                            array_shift($matches); // Remove basepath
                        }

                        $user = $route['class'];
                        $function = $route['function'];

                        // return view or response
                        if ($matches)
                            (new $user($function))->$function($matches[0]);
                        else
                            (new $user($function))->$function();

                        $route_match_found = true;

                        // Do not check other routes
                        break;
                    }
                }
            }
        }

        // No matching route was found
        if (!$route_match_found) {
            // But a matching path exists
            if ($path_match_found) {
                if (self::$methodNotAllowed) {
                    call_user_func_array(self::$methodNotAllowed, array($path, $method));
                }
            } else {
                if (self::$pathNotFound) {
                    call_user_func_array(self::$pathNotFound, array($path));
                }
            }
        }
    }
}