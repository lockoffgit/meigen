<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>名言くん（仮） ver.amagasaki</title>
<meta name="description" content="">
<link type="text/css" rel="stylesheet" href="../css/main.css" />
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
        // IOTWクリックアクション
        var iotw_meigen_id = 1;
        $("a#iotw").live("click", function(e) {
            iotw_meigen_id = $(this).attr("value");
            post_data = {meigen_id : iotw_meigen_id};
            $.ajax({
                    url: "../ajax/iotw.php",
                    type: "POST",
                    data: post_data,
                    dataType: "text",
                    // 登録成功した場合はIOTWをカウントアップ
                    success: function(ret){
                        iotw_div_id = "span#iotw_count" + iotw_meigen_id;
                        // IOTWクリック時の動作
                        $(iotw_div_id)
                            .animate({'fontSize': '18px'},500)
                            .animate({'fontSize': '13px'},400)
                        ;

                        iotw_count = Number($(iotw_div_id).text());
                        $(iotw_div_id).text(iotw_count + 1);
                        if (iotw_count == 10) {
                            if (!confirm('殿堂入りなのでall@lockon.co.jpに送信します（嘘です）')) {
                                return false;
                            }
                        }
                    },
                    error: function(ret){
                        alert(ret);
                    }
            });
            return false;         // Don't jump
        });

        // はぁ？クリックアクション（IOTWと統合可能だけど一旦べたに書く）
        var haa_meigen_id = 1;
        $("a#haa").live("click", function(e) {
            haa_meigen_id = $(this).attr("value");
            haa_div_id = "div#haa_count" + haa_meigen_id;
            haa_count = $(haa_div_id).children().length;
            if (haa_count < 2) {
                if (!confirm('本当に名言を削除してよろしいですか？')) {
                    return false;
                }
            }
            post_data = {meigen_id : haa_meigen_id};
            $.ajax({
                    url: "../ajax/delete.php",
                    type: "POST",
                    data: post_data,
                    dataType: "text",
                    success: function(ret){
                        // 登録成功した場合は はぁ画像をカウントダウン
                        $(haa_div_id + " img:last-child").animate({width: "35%"},100,function(){
                            $(this).fadeOut(500, function(){
                                $(this).remove();
                            });
                            // 墓場処理時のアクションを実行
                            if (haa_count < 2) {
                                $("div#meigen_list" + haa_meigen_id).fadeOut(1000);
                                $("dev#meigen_list" + haa_meigen_id).remove();
                            }
                    });
                    },
                    error: function(ret){
                        alert(ret);
                    }
            });
            return false;         // Don't jump
        });
});
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
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_ranking.png" alt="ランキング"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_cal.png" alt="カレンダー"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_death.png" alt="死にかけリスト"></a></li>
			<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/nav_grave.png" alt="墓地"></a></li>
		</ul>
	</nav>
	<div id="meigen_box">
<!--名言ここから-->
<?php
	require_once("../libs/core.php");
	$objDb = new db_util();
	$arrMeigens = $objDb->getMeigenList();
	foreach($arrMeigens as $meigen){
?>
		<div class="meigen" id="meigen_list<?php echo $meigen['meigen_id']; ?>">
			<div class="meigen-area cf">
				<a href="./detail.php?meigen_id=<?php print $meigen['meigen_id']; ?>">
				<div class="meigen-photo"><img src="../images/member/<?php echo $meigen['member_id']; ?>.jpg"></div>
				<div class="meigen-txt">
                                    <h2 style="font-family: <?php echo $arrFont["{$meigen['font']}"];?>"><?php echo nl2br($meigen['meigen_text']); ?></h2>
					<div class="meigen-detail">
					<p class="date"><?php echo $meigen['created_at']; ?></p>
					<p class="name"><?php echo $meigen['speaker']; ?></p>
					</div>
				</div>
				</a>
			</div>
			<div class="tamashii-area cf">
				<div class="tamashii" id="haa_count<?php echo $meigen['meigen_id']; ?>">
        <?php for ($delete_life_count = 0; (MEIGEN_DELETE_LIFE - $meigen['delete_cnt']) > $delete_life_count; $delete_life_count++) { ?>
					<img src="../img/icon_tamashii.png" height="17">
        <?php } ?>
                                </div>
                           <div class="iine">IOTW！<span id="iotw_count<?php echo $meigen['meigen_id']; ?>"><?php echo $meigen['iotw_cnt']; ?></span>件</div>
			</div>
			<div class="ha-area cf">
				<ul>
                                        <li><a id="haa" href="./index.php" value="<?php echo $meigen['meigen_id']; ?>"><img src="../img/bt_haa.png" alt="はあ？"></a></li>
                                        <li><a id="iotw" href="./index.php" value="<?php echo $meigen['meigen_id']; ?>"><img src="../img/bt_impact.png" alt="ImpactOnTheWorld"></a></li>
					<li><a href="./try.php?meigen_id=<?php print htmlspecialchars($meigen['meigen_id'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../img/bt_wakatta.png" alt="雰囲気わかりました"></a> </li>
				</ul>
			</div>
		</div>
		<!-- /meigen -->
		<?php
	}	// foreach
?>
		<!--名言ここまで-->
	</div>
	<!-- /meigen_box -->
</div>
<div id="loading"><img src="../img/loader.gif"></div>
</body>
</html>
