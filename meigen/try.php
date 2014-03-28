<?php
require_once('../libs/core.php');

session_start();

$params = array_merge($_POST, $_GET);

$objDb = new db_util();

$meigen = array_pop($objDb->select('select * from meigens where meigen_id = ?', [ $params['meigen_id'] ]));
if (is_null($meigen)) {
	header("HTTP/1.0 404 Not Found");
	die();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$member_id = $params['member_id'];
	$member = array_pop($objDb->select('select * from members where member_id = ?', [ $member_id ]));
	if (is_null($member)) {
		header("HTTP/1.0 404 Not Found");
		die();
	}

	// TODO デバッグ
	// $contributor = $_SESSION['facebook_user_id'];
	$contributor = 'dummy-contributorr';

	$unit = array_pop($objDb->select('select * from units where unit_id = ?', [ $member['unit_id'] ]));
	if (is_null($unit)) {
		header("HTTP/1.0 404 Not Found");
		die();
	}

	$font = $params['font'];
	$image_url = '';

	$modified_at = date("Y-m-d H:i:s");
	$addParams = array(
		'meigen_id' => ''.$meigen['meigen_id'],
		"contributor" => $contributor,
		"unit_name" => $unit['unit_name'],
		"font" => $font,
		"member_id" => ''.$member['member_id'],
		"image_url" => $image_url,
		"created_at" => $modified_at,
		"modified_at" => $modified_at,
	);

	$result = $objDb->insert("tries", $addParams);

	header("Location: ./detail.php?meigen_id=".$meigen['meigen_id']);
	exit();
}

$members = $objDb->select("SELECT * FROM members;");
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>雰囲気わかりました</title>
	</head>
	<body>
		<form name="form_regist" action="./try.php" method="POST">
			<input type="hidden" name="meigen_id" value="<?php print htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>" id="meigen_id" />
			<p>発言者(必須): 
				<select name="member_id" id="member_id">
					<?php
					foreach($members as $val){
						print('<option value="' . $val['member_id'] . '">' . $val['name'] . '</option>');
					}
					?>
				</select>
			</p>

			<!-- <p>写真の選択: <input type="file" name="img" id="img" /></p> -->

			<p>フォント(必須): </p>
			<p>
				<input type="radio" name="font" id="font" value="font1" /><label for="font">フォント1</label>
				<input type="radio" name="font" id="font" value="font2" /><label for="font">フォント2</label>
				<input type="radio" name="font" id="font" value="font3" /><label for="font">フォント3</label>
			</p>

			<input type="submit" value="投稿する" />
		</form>

		<br>
		<a href="../meigen/detail.php?meigen_id=<?php print htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>">名言</a>
	</body>
</html>
