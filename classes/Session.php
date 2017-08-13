<?php
/**
 * User: Mohamed Shehata
 * Date: 8/12/2017
 */
class Session {
    public static function check(){
        if (isset($_SESSION['user'])){
            return true;
        } else {
            return false;
        }
    }
    public static function start($session) {
        $_SESSION['user'] = $session;
    }
}