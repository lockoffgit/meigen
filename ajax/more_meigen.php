<?php
    require_once("../libs/core.php");
    $objDb = new db_util();
    $page_no = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
    $arrMeigens = $objDb->getMeigenList($page_no);
    if(count($arrMeigens) > 0){
        foreach($arrMeigens as $meigen){
            $return .= <<<EOF
		<div class="meigen">
			<div class="meigen-area cf">
				<a href="./detail.php?meigen_id={$meigen['meigen_id']}">
				<div class="meigen-photo"><img src="../images/member/{$meigen['meigen_id']}.jpg"></div>
				<div class="meigen-txt">
                                        <h2>{$meigen['meigen_text']}</h2>
					<div class="meigen-detail">
                                        <p class="date">{$meigen['created_at']}</p>
					<p class="name">{$meigen['speaker']}</p>
					</div>
				</div>
				</a>
			</div>
			<div class="tamashii-area cf">
				<div class="tamashii">
					<img src="../img/icon_tamashii.png" height="17"><img src="../img/icon_tamashii.png" height="17"><img src="../img/icon_tamashii.png" height="17">
				</div>
				<div class="iine">いいね！2件</div>
			</div>
			<div class="ha-area cf">
				<ul>
					<li><a href="javascript:alert('かみんぐすぅん');"><img src="../img/bt_haa.png" alt="はあ？"></a></li>
					<li><a href="javascript:alert('本当にcore@lockon.co.jpにメールを飛ばしてもいいですか？');"><img src="../img/bt_impact.png" alt="ImpactOnTheWorld"></a></li>
					<li> <a href="./try.php?meigen_id={$meigen['meigen_id']}<img src="../img/bt_wakatta.png" alt="雰囲気わかりました"></a> </li>
				</ul>
			</div>
		</div>
EOF;
        }
    echo $return;
    }else{
        echo '<div id="no_more">これ以上ありませんよ</div>';
    }
?>