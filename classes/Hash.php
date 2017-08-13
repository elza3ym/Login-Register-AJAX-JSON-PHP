<?php
Class Hash {
    public static function gen($string){
        return password_hash($string, PASSWORD_BCRYPT);
    }
}