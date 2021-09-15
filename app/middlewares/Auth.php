<?php

namespace App\middlewares;

class Auth
{
    public static function requireLogin($functions, $calledFunction)
    {
        //if authentication is required
        if ($functions == '*' || in_array($calledFunction, $functions)) {
            // check for user id session and created session
            if ($_SESSION['user_id'] && $_SESSION['CREATED']) {
                // if session passes 30 minutes since created destroy session and require re-login
                if (time() - $_SESSION['CREATED'] > 1800) {
                    session_destroy();
                    redirect(base_url('login')); // session expired. require re-login
                } else
                    return true; // user is logged in
            } else
                redirect(base_url('login')); // user is not logged in
        }

        return null; // authentication is not required
    }
}