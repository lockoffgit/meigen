<?php
require('../libs/core.php');
$objDb = new db_util();
$graves = $objDb->select("SELECT * FROM graves ORDER BY grave_id DESC");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>名言くん（仮） ver.amagasaki</title>
<meta name="description" content="">
<link type="text/css" rel="stylesheet" href="../css/main.css" />
</head>

<body>
<?php include_once("../analyticstracking.php"); ?>
<div class="container">
	<header class="cf">
            <div class="navbar-brand"> <a href="<?php echo MEIGEN_TOP_URL_HTTP . '?' . MEIGEN_SESSION_SORT_KEY . '=new'; ?>"><img src="../img/title.png"></a></div>
		<div class="navbar-entry"><a href="./nyuu.php"><img src="../img/bt_entry.png" alt="投稿する"></a></div>
	</header>
    	<nav>
		<ul class="navbar-nav cf">
			<li><a href="<?php echo MEIGEN_TOP_URL_HTTP . '?' . MEIGEN_SESSION_SORT_KEY . '=iotw'; ?>"><img src="../img/nav_ranking.png" alt="ランキング"></a></li>
			<li><a href="<?php echo MEIGEN_TOP_URL_HTTP . '?' . MEIGEN_SESSION_SORT_KEY . '=new'; ?>"><img src="../img/nav_cal.png" alt="カレンダー"></a></li>
			<li><a href="<?php echo MEIGEN_TOP_URL_HTTP . '?' . MEIGEN_SESSION_SORT_KEY . '=delete'; ?>"><img src="../img/nav_death.png" alt="死にかけリスト"></a></li>
                        <li><a href="../bochi/index.php"><img src="../img/nav_grave.png" alt="墓地"></a></li>
		</ul>
	</nav>
	<div id="meigen_box">
<!--名言ここから-->
        <?php
        if (count($graves) > 0) {
            foreach($graves as $grave) {
        ?>
                        <div class="meigen-area cf">
                                <div class="meigen-txt">
                                    <h2 style="font-family: <?php echo $arrFont["{$grave['font']}"];?>"><?php echo nl2br($grave['meigen_text']); ?></h2>
                                        <div class="meigen-detail">
                                        <p class="name"><?php echo $grave['speaker']; ?></p>
                                        <p class="date"><?php echo $grave['contributor']; ?></p>
                                        </div>
                                </div>
                        </div>
			<div class="tamashii-area cf">
				<div class="tamashii">
        <?php for ($delete_life_count = 0; $grave['together'] > $delete_life_count; $delete_life_count++) { ?>
					<img src="../img/icon_tamashii.png" height="17">
        <?php } ?>
                                </div>
                           <div class="iine">道連れ数：<?php echo $grave['together']; ?>件</div>
			</div>
        <?php

            }
        } else {
        ?>
            <td colspan="6">墓は空のようだ</td>
        <?php
        }
        ?>
        <!--名言ここまで-->
	</div>
	<!-- /meigen_box -->
</div>
<div id="loading"><img src="../img/loader.gif"></div>
</body>
</html>

