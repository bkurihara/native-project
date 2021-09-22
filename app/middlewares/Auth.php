<?php

namespace App\middlewares;

use Jenssegers\Blade\Blade;

class Auth
{
    public static function requireLogin($functions, $calledFunction)
    {
        //if authentication is required
        if ($functions == '*' || in_array($calledFunction, $functions)) {
            // check for user id session and created session
            if (Auth::isLoggedIn()) {
                if (!self::validateSession()) {
                    $blade = new Blade('views', 'cache');
                    echo $blade->render('errors.405');
                }
                $minutesPassed = round((time() - $_SESSION['CREATED']) / 60);

                if ($minutesPassed > 1 && time() - $minutesPassed < 30) {
//                  // refresh session every 1 minute if it hasn7t passed 30 minutes since created
                    self::regenerateSession();
                } else if ($minutesPassed > 30) {
                    // user session passes 30 minutes therefore
                    // destroy the sessions and redirect to login page
                    self::destroySession();
                    redirect(base_url('login'));
                }
            } else
                // user not logged in
                redirect(base_url('login'));
        }
    }

    public static function isLoggedIn()
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['CREATED'])
            && isset($_SESSION['user_agent']))
            return true;
        else
            return false;
    }

    public static function validateSession()
    {
        return $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'];
    }

    public static function regenerateSession()
    {
        session_regenerate_id(true);
        $_SESSION['CREATED'] = time();
    }

    public static function destroySession()
    {
        session_unset();
        session_destroy();
    }

//    function my_session_start()
//    {
//        if (isset($_SESSION['destroyed'])) {
//            if ($_SESSION['destroyed'] < time() - 300) {
//                // Should not happen usually. This could be attack or due to unstable network.
//                // Remove all authentication status of this users session.
//                remove_all_authentication_flag_from_active_sessions($_SESSION['userid']);
//                throw(new DestroyedSessionAccessException);
//            }
//            if (isset($_SESSION['new_session_id'])) {
//                // Not fully expired yet. Could be lost cookie by unstable network.
//                // Try again to set proper session ID cookie.
//                // NOTE: Do not try to set session ID again if you would like to remove
//                // authentication flag.
//                session_commit();
//                session_id($_SESSION['new_session_id']);
//                // New session ID should exist
//                session_start();
//                return;
//            }
//        }
//    }
//
//    function my_session_regenerate_id()
//    {
//        // New session ID is required to set proper session ID
//        // when session ID is not set due to unstable network.
//        $new_session_id = session_create_id();
//        $_SESSION['new_session_id'] = $new_session_id;
//
//        // Set destroy timestamp
//        $_SESSION['destroyed'] = time();
//
//        // Write and close current session;
//        session_commit();
//
//        // Start session with new session ID
//        session_id($new_session_id);
//        ini_set('session.use_strict_mode', 0);
//        session_start();
//        ini_set('session.use_strict_mode', 1);
//
//        // New session does not need them
//        unset($_SESSION['destroyed']);
//        unset($_SESSION['new_session_id']);
//    }
}