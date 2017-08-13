<?php
require_once 'init.php';
if ($_POST) {
    $user = new User();
    $register = $user->register($_POST['name'],$_POST['email'], $_POST['password'], $_POST['password_confirmation'], $_POST['phone']);
} else {
    header('Location:/');
}