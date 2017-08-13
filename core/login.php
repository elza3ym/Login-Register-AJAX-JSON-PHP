<?php
require_once 'init.php';
if ($_POST) {
    $user = new User();
    $login = $user->login($_POST['email'], $_POST['password']);
} else {
    header('Location:/');
}
