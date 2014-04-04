<?php
require_once('../libs/core.php');

$params = $_GET;

$objDb = new db_util();

$meigen = array_pop($objDb->select('select * from meigens where meigen_id = ?', array($params['meigen_id'])));
if (is_null($meigen)) {
	header("HTTP/1.0 404 Not Found");
	die();
}

$tries = $objDb->select('select * from tries where meigen_id = ? order by try_id desc', array($params['meigen_id']));

?><!DOCTYPE html>
<html class="no_js" lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>名言くん（仮） ver.amagasaki - 詳細 -</title>
    <meta name="description" content="">
    <link type="text/css" rel="stylesheet" href="../css/main.css" />
</head>

<div class="container">
	<header class="cf">
            <div class="navbar-brand"> <a href="./"><img src="../img/title.png"></a></div>
		<div class="navbar-entry"><a href="./nyuu.php"><img src="../img/bt_entry.png" alt="投稿する"></a></div>
	</header>
	<nav>
		<ul class="navbar-nav cf">
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_ranking.png" alt="ランキング"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_cal.png" alt="カレンダー"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_death.png" alt="死にかけリスト"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_grave.png" alt="墓地"></a></li>
		</ul>
	</nav>
	<div id="meigen_box">
		<div class="meigen" id="meigen_list<?php echo $meigen['meigen_id']; ?>">
			<div class="meigen-area cf">
				<a href="./detail.php?meigen_id=<?php print $meigen['meigen_id']; ?>">
				<div class="meigen-photo"><img src="../images/member/<?php echo $meigen['member_id']; ?>.jpg"></div>
				<div class="meigen-txt">
                                    <h2 style="font-family: <?php echo $arrFont["{$meigen['font']}"];?>"><?php echo nl2br($meigen['situation']); ?></h2>
					<div class="meigen-detail">
					<p class="date"><?php echo $meigen['created_at']; ?></p>
					<p class="name"><?php echo $meigen['speaker']; ?></p>
					</div>
				</div>
				</a>
			</div>
			<div class="tamashii-area cf">
				<div class="tamashii" id="haa_count<?php echo $meigen['meigen_id']; ?>">
                                </div>
			</div>
		</div>
            <?php
            foreach ($tries as $try) {
            ?>
		<div class="meigen">
			<div class="meigen-area cf">
				<div class="meigen-photo"><img src="../images/member/<?php echo $try['member_id']; ?>.jpg"></div>
				<div class="meigen-txt">
                                    <h2 style="font-family: <?php echo $arrFont["{$try['font']}"];?>">まだコメントは投稿できません</h2>
				</div>
			</div>
		</div>
            <?php
            }
            ?>

        </div>
</div>
</body>
</html>
