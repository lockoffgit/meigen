<?php
require_once('../libs/database.php');

$params = array_merge($_POST, $_GET);

$objDb = new db_util();

$meigen = array_pop($objDb->select('select * from meigens where meigen_id = ?', [ $params['meigen_id'] ]));
$tries = $objDb->select('select * from tries where meigen_id = ?', [ $meigen['meigen_id'] ]);
?><!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>だいたいわかりましたページ - 名言くん</title>
	</head>

	<body>
		<div class="navbar navbar-default">
			<div class="navbar-inner">
				<div class="container">
					<h1><a href="javascript:void(0);" class="brand">名言くん</a></h1>
					<ul class="nav pull-right">
						<li><a href="javascript:void(0);">ここにアカウント名</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
			<h2>だいたいわかりましたページ</h2>

			<div>
				<h3>詳細</h3>
<?php
echo '<p>' . htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['contributor'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['speaker'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['meigen_text'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['unit_name'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['situation'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['font'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['member_id'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['image_url'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['created_at'], ENT_QUOTES,'UTF-8') . '</p>';
echo '<p>' . htmlspecialchars($meigen['modified_at'], ENT_QUOTES,'UTF-8') . '</p>';
?>

				<h3>だいたいわかりました</h3>
<?php
foreach ($tries as $try) {
	echo '<p>' . htmlspecialchars($try['contributor'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['meigen_id'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['unit_name'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['font'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['member_id'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['image_url'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['created_at'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($try['modified_at'], ENT_QUOTES,'UTF-8') . '</p>';
}
?>

				<a href="../meigen/index.php">名言</a>
				<a href="../meigen/try.php?meigen_id=<?php echo htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>">使ってみた登録</a>
			</div>
		</div>

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
	</body>
</html>
