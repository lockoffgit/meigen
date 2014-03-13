<?php
require_once('../libs/database.php');

$params = array_merge($_POST, $_GET);

$objDb = new db_util();

$meigen = array_pop($objDb->select('select * from meigens where meigen_id = ?', [ $params['meigen_id'] ]));
if (is_null($meigen)) {
	header("HTTP/1.0 404 Not Found");
	die();
}

$tries = $objDb->select('select * from tries where meigen_id = ? order by try_id desc', [ $params['meigen_id'] ]);
?><!DOCTYPE html>
<html class="no_js" lang="ja">
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="">
	<link type="text/css" rel="stylesheet" href="../css/main.css" />
	<title>名言くん（仮）</title>
</head>

<body>
<div class="container">
	<div class="navbar">
		<div class="navbar-header">
			<div class="navbar-brand">
				<a href="./">名言くん</a>
			</div>
			<div class="navbar-entry"><a href="./nyuu.php">投稿する</a></div>
		</div>
	</div>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav">
			<li><a href="work.html">RANKING</a></li>
			<li><a href="about.html">CALLENDER</a></li>
			<li><a href="blog.html">SHINIKAKE</a></li>
			<li><a href="contact.html">BOCHI</a></li>
		</ul>
	</div>


	<div class="meigen">
		<div class="meigen-area">
			<div class="meigen-photo"><img src="<?php echo $meigens['meigen_image_url']; ?>"></div>
			<div class="meigen-txt">
				<div class="meigen-detail">
				<h2>高橋くんデザインお願いします</h2>
				<?php
					echo '<p>' . nl2br(htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['contributor'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['speaker'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['meigen_text'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['unit_name'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['situation'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['font'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['member_id'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['image_url'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['created_at'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($meigen['modified_at'], ENT_QUOTES,'UTF-8')) . '</p>';
				?>
				</div>
				<div class="meigen-detail">
				<?php
				foreach ($tries as $try) {
					echo '<p>' . nl2br(htmlspecialchars($try['contributor'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['meigen_id'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['unit_name'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['font'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['member_id'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['image_url'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['created_at'], ENT_QUOTES,'UTF-8')) . '</p>';
					echo '<p>' . nl2br(htmlspecialchars($try['modified_at'], ENT_QUOTES,'UTF-8')) . '</p>';
				}
				?>
				</div>
			</div>
		</div>
		<div class="ha-area">
			<ul>
				<li><a href="../meigen/index.php">名言</a></li>
				<li><a href="../meigen/try.php?meigen_id=<?php echo htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>">使ってみた登録</a></li>
			</ul>
		</div>
	</div>

</div>
<a href="../meigen/">めいげん</a>
</body>
</html>
