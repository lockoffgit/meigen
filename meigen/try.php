<?php
require_once('../libs/core.php');

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $params = $_POST;    
} else {
    $params = $_GET;
}

$objDb = new db_util();

$meigen = array_pop($objDb->select('select * from meigens where meigen_id = ?',  array($params['meigen_id'])));
if (is_null($meigen)) {
	header("HTTP/1.0 404 Not Found");
	die();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$member_id = $params['member_id'];
	$member = array_pop($objDb->select('select * from members where member_id = ?', array($member_id)));
	if (is_null($member)) {
		header("HTTP/1.0 404 Not Found");
		die();
	}

	// TODO デバッグ
	// $contributor = $_SESSION['facebook_user_id'];
	$contributor = 'dummy-contributorr';

	$unit = array_pop($objDb->select('select * from units where unit_id = ?', array($member['unit_id'])));
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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>名言くん（仮） ver.amagasaki 新規登録</title>
<meta name="description" content="">
<link type="text/css" rel="stylesheet" href="../css/main.css" />
</head>
<body>
<?php include_once("../analyticstracking.php"); ?>
<div class="container">
	<header class="cf">
            <div class="navbar-brand"> <a href="./"><img src="../img/title.png"></a></div>
		<div class="navbar-entry"><a href="./nyuu.php"><img src="../img/bt_entry.png" alt="投稿する"></a></div>
	</header>
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
        </div>
    </div>
</body>
</html>
