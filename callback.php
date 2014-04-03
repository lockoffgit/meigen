<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * Callback for Opauth
 * 
 * This file (callback.php) provides an example on how to properly receive auth response of Opauth.
 * 
 * Basic steps:
 * 1. Fetch auth response based on callback transport parameter in config.
 * 2. Validate auth response
 * 3. Once auth response is validated, your PHP app should then work on the auth response 
 *    (eg. registers or logs user in to your site, save auth data onto database, etc.)
 * 
 */


/**
 * Define paths
 */
define('CONF_FILE', dirname(__FILE__).'/auth/'.'opauth.conf.php');
// define('OPAUTH_LIB_DIR', dirname(dirname(__FILE__)).'/lib/Opauth/');

require __DIR__ . "/vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('/var/log/meigen/app.log', Logger::DEBUG));

$log->addDebug("callback in.");
/**
* Load config
*/
if (!file_exists(CONF_FILE)) {
	trigger_error('Config file missing at '.CONF_FILE, E_USER_ERROR);
	exit();
}
require CONF_FILE;

/**
 * Instantiate Opauth with the loaded config but not run automatically
 */
// require OPAUTH_LIB_DIR.'Opauth.php';
$Opauth = new Opauth( $config, false );

	
/**
* Fetch auth response, based on transport configuration for callback
*/
$response = null;

switch($Opauth->env['callback_transport']) {
	case 'session':
		session_start();
		$response = $_SESSION['opauth'];
		unset($_SESSION['opauth']);
		break;
	case 'post':
		$response = unserialize(base64_decode( $_POST['opauth'] ));
		break;
	case 'get':
		$response = unserialize(base64_decode( $_GET['opauth'] ));
		break;
	default:
		echo '<strong style="color: red;">Error: </strong>Unsupported callback_transport.'."<br>\n";
		break;
}

/**
 * Check if it's an error callback
 */
if (array_key_exists('error', $response)) {
	echo '<strong style="color: red;">Authentication error: </strong> Opauth returns error auth response.'."<br>\n";
}

/**
 * Auth response validation
 * 
 * To validate that the auth response received is unaltered, especially auth response that 
 * is sent through GET or POST.
 */
else{
	if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
		echo '<strong style="color: red;">Invalid auth response: </strong>Missing key auth response components.'."<br>\n";
	} elseif (!$Opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
		echo '<strong style="color: red;">Invalid auth response: </strong>'.$reason.".<br>\n";
	} else {
		echo '<strong style="color: green;">OK: </strong>Auth response is validated.'."<br>\n";

		/**
		 * It's all good. Go ahead with your application-specific authentication logic
		 */
	}
}

// ログインユーザの社員情報を取得する	
session_start();
$facebook_user_id = $response['auth']['uid'];
$_SESSION['facebook_user_id'] = $facebook_user_id;
$log->addInfo("http://localhost" . $_SESSION['redirect_to']);

$sql = <<<EOB
SELECT
	member_id,
	name,
	handle_name,
	unit_name
FROM
	members INNER JOIN units ON units.unit_id = members.unit_id
WHERE
	facebook_user_id = ?
	AND members.del_flag = 0
EOB;

require_once('./libs/core.php');
require_once('./libs/database.php');
$objDb = new db_util();
$result = $objDb->select($sql, array($facebook_user_id));

$result = file_get_contents("https://graph.facebook.com/me/groups?access_token=" . $response['auth']['credentials']['token']);
$groups = json_decode($result);
$inGroup = false;
foreach ($groups->data as $group) {
	if ($group->id == 590989957588708) {
		$inGroup = true;
		break;
	}
}

if (!$inGroup && count($result) == 0) {
	// グループに所属していないので利用不可能
	echo "使えません";
	exit();
}

$userInfo['facebook_user_id'] = $facebook_user_id;
$userInfo['member_id'] = $result[0]['member_id'];
$userInfo['name'] = $result[0]['name'];
$userInfo['handle_name'] = $result[0]['handle_name'];
$userInfo['unit_name'] = $result[0]['unit_name'];

// cookieに認証情報を登録
setcookie('login_token', $userInfo['facebook_user_id'] . "@" . $userInfo['member_id'], 0, "/");
setcookie('userInfo', $userInfo, 0, "/");
header("Location: /meigen/index.php",true,303);
?>
<html>
	<head><meta charset="utf-8"></head>
</html>