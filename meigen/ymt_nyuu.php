<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>よくわかりました投稿</title>
</head>

<body>
<?php include_once("../analyticstracking.php"); ?>
	<p>よくわかりました投稿</p>

	<p>大は小をかねない</p>

	<form action="detail.php" method="post">
		<p>写真の選択: <input type="file" name="img" id="img" size="50" /></p>
		<p>フォント: </p>
		<p>
			<input type="radio" name="font" id="font" value="font1" /><label for="font">フォント1</label>
			<input type="radio" name="font" id="font" value="font2" /><label for="font">フォント2</label>
			<input type="radio" name="font" id="font" value="font3" /><label for="font">フォント3</label>
		</p>
		<input type="submit" value="投稿する" />
	</form>

	<br>

	<a href="../meigen/meigen.php">めいげん</a>
	<a href="../meigen/detail.php">やってみたリスト</a>
</body>

</html>
