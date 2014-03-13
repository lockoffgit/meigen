<?php
require __DIR__ . "/../vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('/var/log/meigen/app.log', Logger::DEBUG));

/**
 * 未ログインのユーザをログインページへ誘導するフィルタ
 */
$originalURI = $_SERVER['REQUEST_URI'];
$isSkipAuth = false;
/*
$log->addInfo('login_filter REQUEST_URI = ' . $originalURI);
$isSkipAuth =
	   (preg_match('|^/facebook.*$|', $originalURI))
	|| (preg_match('|^/auth.*$|', $originalURI))
	|| (preg_match('|^/callback.*$|', $originalURI));
*/
$log->addDebug('login_token = ' . $_COOKIE['login_token']);

if ($isSkipAuth) {
	$log->addDebug("isAuthPage is true.");
} else {
	$log->addDebug("isAuthPage is false.");
}
$log->addDebug('$isSkipAuth = ' . $isSkipAuth);

if (!$isSkipAuth && !isset($_COOKIE['login_token'])) {
	session_start();
	$log->addInfo("login_filter ログインページへリダイレクト");
	$log->addInfo("login_filter 元のページ = " . $originalURI);
	$_SESSION['redirect_to'] = $originalURI;

	header("Location: /facebook",true,303);
}

