<?php
    require_once("../libs/database.php");
    define("LIST_MAX", 10);
    $page_no = isset($_GET['page_no']) ? (($_GET['page_no'] - 1) * LIST_MAX) : 0;

    $objDb = new db_util();
    $query = "
    SELECT
        mei.*
        ,(
            SELECT
                    COUNT(x.iotw_id)
                FROM
                    iotws x
                WHERE
                    x.meigen_id = mei.meigen_id
        ) AS iotw_cnt
        ,(
            SELECT
                    COUNT(x.delete_id)
                FROM
                    deletes x
                WHERE
                    x.meigen_id = mei.meigen_id
        ) AS delete_cnt
        ,COALESCE(
            mei.image_url
            ,mem.image_url
        ) AS meigen_image_url
    FROM
        meigens AS mei LEFT OUTER JOIN members mem
            ON (
            mei.member_id = mem.member_id
        )
    ORDER BY
        mei.modified_at DESC
	LIMIT " . $page_no . ", 10
    ";

    $arrMeigens = $objDb->select($query);
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
		<li>
			<a href="./detail.php?meigen_id=<?php print htmlspecialchars($meigens['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../img/3.jpg" alt="雰囲気わかりました"></a>
		</li>
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
