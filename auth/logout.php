<?php

setcookie('login_token', '' ,time() -100, "/");

$log->addWarning('login_token = ' . $_COOKIE['login_token']);
?>

logout.