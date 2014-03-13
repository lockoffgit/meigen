<?php
require('../libs/database.php');

$objDb = new db_util();
if (count($_POST) != 0) {
//	$contributor = $_SESSION['facebook_user_id'];
	$contributor = 'dummy-contributorr';

	$member_id = htmlspecialchars($_POST['speaker'], ENT_QUOTES);
	$person = $objDb->select("SELECT name FROM members WHERE member_id=$member_id;");
	foreach($person as $val){
            $speaker = $val['name'];
	}
	$meigen_text = htmlspecialchars($_POST['meigen_text'], ENT_QUOTES);
	$unit_name = htmlspecialchars($_POST['unit_name'], ENT_QUOTES);
	$situation = htmlspecialchars($_POST['situation'], ENT_QUOTES);
	$font = htmlspecialchars($_POST['font'], ENT_QUOTES);
	$image_url = '';
	$addParams = array(
		"contributor"	=> $contributor,
		"speaker"	=> $speaker,
		"meigen_text"	=> $meigen_text,
		"unit_name"	=> $unit_name,
		"situation"	=> $situation,
		"font"		=> $font,
		"member_id"	=> $member_id,
		"image_url"	=> $image_url
	);

	$result = $objDb->insert("meigens", $addParams);

	header("Location: ./meigen.php");
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>名言新規登録</title>
</head>

<body>

	<form name="form_regist" action="./nyuu.php" method="POST">
		<p>発言者(必須): 
			<select name="speaker" id="speaker">
				<?php

    			$member = $objDb->select("SELECT member_id, name FROM members;");
    		 	foreach($member as $val){
    				print('<option value="' . $val['member_id'] . '">' . $val['name'] . '</option>');
				}

				?>
			</select>
		</p>

		<p>ユニット名: 
			<select name="unit_name">
				<?php
				
    			$unit = $objDb->select("SELECT unit_name FROM units;");
    		 	foreach($unit as $val){
    				print('<option value="' . $val['unit_name'] . '">' . $val['unit_name'] . '</option>');
				}

				?>

			</select>

		<!-- <p>写真の選択: <input type="file" name="img" id="img" /></p> -->

		<p>名言(必須): <input type="text" name="meigen_text" id="meigen_text" maxlength="255" /></p>

		<p>フォント(必須): </p>
		<p>
			<input type="radio" name="font" id="font" value="font1" /><label for="font">フォント1</label>
			<input type="radio" name="font" id="font" value="font2" /><label for="font">フォント2</label>
			<input type="radio" name="font" id="font" value="font3" /><label for="font">フォント3</label>
		</p>

		<p>名言の背景(必須): </p>
		<p><textarea name="situation" id="situation" rows="5" column="20" maxlength="255"></textarea></p>

		<input type="submit" value="投稿する" />
	</form>

	<br>
	<a href="../meigen/meigen.php">名言</a>
</body>

</html>
