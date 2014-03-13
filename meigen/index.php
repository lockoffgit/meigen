<?php
    require_once("../libs/database.php");
    define("LIST_MAX", 10);
    $objDb = new db_util();
    $query = "
    SELECT
        Mei.*
        ,COUNT(Iot.iotw_id) AS iotw_cnt
        ,COUNT(del.delete_id) AS delete_cnt
        ,COALESCE(
            Mei.image_url
            ,Mem.image_url
        ) AS meigen_image_url
    FROM
        meigens AS Mei LEFT OUTER JOIN members AS Mem
            ON Mem.member_id = Mei.member_id LEFT OUTER JOIN iotws AS Iot
            ON Iot.meigen_id = Mei.meigen_id LEFT OUTER JOIN deletes AS del
            ON del.meigen_id = Mei.meigen_id
    WHERE
        Mem.del_flag <> 1
    GROUP BY
        Iot.meigen_id
        ,del.meigen_id
    ORDER BY
        modified_at DESC
    ";
    $page_no = $_GET['page_no'] ? ($_GET['page_no'] - 1) * LIST_MAX : 0;
    $params[] = $page_no;
    $arrMeigens = $objDb->select($query, $params);
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
      <a href="index.html">名言くん</a>
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


<!--名言ここから-->
<?php
    foreach($arrMeigens as $meigens){
?>
    <div class="meigen">
	<div class="meigen-area">
		<div class="meigen-photo"><img src="<?php echo $meigens['meigen_image_url']; ?>"></div>
		<div class="meigen-txt">
		  	<div class="meigen-detail">
			<p><?php echo nl2br($meigens['meigen_text']); ?></p>
			<p>
                            <?php echo $meigens['speaker']; ?><br>
                            <span class="day">
                                <?php echo $meigens['created_at']; ?>
                            </span>
                        </p>
			<div>●●●</div>
		  </div>
		</div>
	</div>
	<div class="ha-area">
		<ul>
	    <li><a href="#"><img src="../img/1.jpg" alt="はあ？"></a></li>
	    <li><a href="#"><img src="../img/2.jpg" alt="ImpactOnTheWorld"></a></li>
	    <li><a href="#"><img src="../img/3.jpg" alt="雰囲気わかりました"></a></li>
	    </ul>
	</div>
    </div>
<?php
    }   // foreach
?>
<!--名言ここまで-->

</div>
</body>
    <a href="../meigen/">めいげん</a>
</html>
