<?php
require('../libs/core.php');

$objDb = new db_util();
if (count($_POST) != 0) {
	session_start();
	$contributor = $_SESSION['facebook_user_id'];
        //$contributor = 'dummy-contributorr';

	$member_id = $_POST['speaker'];
	$person = $objDb->select("SELECT name FROM members WHERE member_id=$member_id;");
	foreach($person as $val){
		$speaker = $val['name'];
	}

	$meigen_text = $_POST['meigen_text'];
	$unit_name = $_POST['unit_name'];
	$situation = $_POST['situation'];
	$font = $_POST['font'];
	$image_url = '';
	$created_at = date("Y-m-d H:i:s");
	$modified_at = $created_at;
	$addParams = array(
		"contributor"	=> $contributor,
		"speaker"	=> $speaker,
		"meigen_text"	=> $meigen_text,
		"unit_name"	=> $unit_name,
		"situation"	=> $situation,
		"font"		=> $font,
		"member_id"	=> $member_id,
		"image_url"	=> $image_url,
		"created_at" => $created_at,
		"modified_at" => $modified_at,
	);

	$result = $objDb->insert("meigens", $addParams);
	header("Location: ./index.php");
	exit();
}

?>

<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>名言くん（仮） ver.amagasaki 新規登録</title>
<meta name="description" content="">
<link type="text/css" rel="stylesheet" href="../css/main.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/jquery.bottom.js"></script>
<script>
</script>
</head>
<body>
<div class="container">
	<header class="cf">
            <div class="navbar-brand"> <a href="./"><img src="../img/title.png"></a></div>
		<div class="navbar-entry"><a href="./nyuu.php"><img src="../img/bt_entry.png" alt="投稿する"></a></div>
	</header>
	<nav>
		<ul class="navbar-nav cf">
			<li>新規登録</li>
		</ul>
	</nav>
	<div id="meigen_box">

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
    				echo '<option value="' . $val['unit_name'] . '">' . $val['unit_name'] . '</option> ';
				}

				?>

			</select>

		<!-- <p>写真の選択: <input type="file" name="img" id="img" /></p> -->

		<p>名言(必須): <input type="text" name="meigen_text" id="meigen_text" maxlength="255" /></p>

		<p>フォント(必須): </p>
		<p>
                    <?php foreach ($arrFont as $key => $val) { 
                        print ('<div style="font-family: ' . $val .'" /><input type="radio" name="font" id="font" value="' . $key .'" /><label for="font">ふぉんと</label></div>');
                    } ?>
		</p>

		<p>名言の背景(必須): </p>
		<p><textarea name="situation" id="situation" rows="5" column="20" maxlength="255"></textarea></p>

		<input type="submit" value="投稿する" />
	</form>
        </div>
</div>
</body>

</html>
