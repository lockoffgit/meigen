<?php
$dsn = "mysql:host=127.0.0.1;dbname=meigen_db"; 
$user = 'meigen_user';
$password = 'vwzJ7F4u';

try {
	$pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	print('Error:'.$e->getMessage());
	die();
}

$params = array_merge($_POST, $_GET);

$stmt = $pdo->prepare('select * from meigens where meigen_id = :meigenId');
$stmt->bindValue(':meigenId', 1, PDO::PARAM_INT);
if (!$stmt->execute()) {
	$info = $stmt->errorInfo();
	exit($info[2]);
}
?>

<!DOCTYPE html>
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
<?php
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<p>' . htmlspecialchars($data['meigen_id'], ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['contributor'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['speaker'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['meigen_text'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['unit_name'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['situation'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['font'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['member_id'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['image_url'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['created_at'], ENT_QUOTES,'UTF-8') . '</p>';
	echo '<p>' . htmlspecialchars($data['modified_at'], ENT_QUOTES,'UTF-8') . '</p>';
}










?>
				<a href="../meigen/meigen.php">名言</a>
				<a href="../meigen/ymt_nyuu.php">使ってみた登録</a>
			</div>
		</div>

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
	</body>
</html>
