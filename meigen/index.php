<!DOCTYPE html>
<html class="no_js" lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="description" content="">
<link type="text/css" rel="stylesheet" href="../css/main.css" />
<title>名言くん（仮）</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/jquery.bottom.js"></script>
<script>
$(function(){
    var page_no = 1;
    $(window).bottom({proximity: 0});
    $(window).on("bottom", function(){
        var obj = $(this);
        if (!obj.data('loading')) {
            obj.data('loading', true);
            $("#loading").css("display", "block");

            data = {page_no : page_no};
            $.ajax({
                url: "../ajax/more_meigen.php",
                type: "POST",
                data: data,
                dataType: "text",
                success: function(ret){
                    $("#loading").css("display", "none");
                    $("#meigen_box").append(ret);
                    page_no++;
                    obj.data('loading', false);
                }
            });
        }
    });
})
</script>
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
    <li><a href="ranking.php">RANKING</a></li>
    <li><a href="calendar.php">CALENDAR</a></li>
    <li><a href="shinikake.php">SHINIKAKE</a></li>
    <li><a href="bochi.php">BOCHI</a></li>
  </ul>
</div>

    <div id="meigen_box">
<!--名言ここから-->
<?php
    require_once("../libs/core.php");
    $objDb = new db_util();
    $arrMeigens = $objDb->getMeigenList();

    foreach($arrMeigens as $meigen){
?>
    <div class="meigen">
	<div class="meigen-area">
		<div class="meigen-photo"><img src="/images/member/<?php echo $meigen['member_id']; ?>.jpg"></div>
		<div class="meigen-txt">
		  	<div class="meigen-detail">
			<p><?php echo nl2br($meigen['meigen_text']); ?></p>
			<p>
				<?php echo $meigen['speaker']; ?><br>
				<span class="day">
					<?php echo $meigen['created_at']; ?>
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
			<a href="./detail.php?meigen_id=<?php print htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../img/3.jpg" alt="雰囲気わかりました"></a>
		</li>
	    </ul>
	</div>
    </div><!-- /meigen -->
<?php
    }   // foreach
?>
<!--名言ここまで-->
    </div><!-- /meigen_box -->
</div>
    <div id="loading">
        ローディング中
    </div>
</body>
</html>