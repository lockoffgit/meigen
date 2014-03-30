<?php
    require_once("../libs/core.php");
    $objDb = new db_util();
    $page_no = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
    $arrMeigens = $objDb->getMeigenList($page_no);
    if(count($arrMeigens) > 0){
        foreach($arrMeigens as $meigen){
            $meigen_text = htmlspecialchars($meigen['meigen_text']);
            $font = $arrFont["{$meigen['font']}"];
            $return .= <<<EOF
		<div class="meigen" id="meigen_list{$meigen['meigen_id']}">
			<div class="meigen-area cf">
				<a href="./detail.php?meigen_id={$meigen['meigen_id']}">
				<div class="meigen-photo"><img src="../images/member/{$meigen['member_id']}.jpg"></div>
				<div class="meigen-txt">
                                        <h2 style="font-family: {$font}">{$meigen_text}</h2>
					<div class="meigen-detail">
                                        <p class="date">{$meigen['created_at']}</p>
					<p class="name">{$meigen['speaker']}</p>
					</div>
				</div>
				</a>
			</div>
			<div class="tamashii-area cf">
				<div class="tamashii" id="haa_count{$meigen['meigen_id']}">
EOF;
            for ($delete_life_count = 0; (MEIGEN_DELETE_LIFE - $meigen['delete_cnt']) > $delete_life_count; $delete_life_count++) {
                $return .= '               <img src="../img/icon_tamashii.png" height="17">';
            }
            $return .= <<<EOF
				</div>
                                <div class="iine">IOTW！<span id="iotw_count{$meigen['meigen_id']}">{$meigen['iotw_cnt']}</span>件</div>
			</div>
			<div class="ha-area cf">
				<ul>
                                        <li><a id="haa" href="./index.php" value="{$meigen['meigen_id']}"><img src="../img/bt_haa.png" alt="はあ？"></a></li>
                                        <li><a id="iotw" href="./index.php" value="{$meigen['meigen_id']}"><img src="../img/bt_impact.png" alt="ImpactOnTheWorld"></a></li>
                                        <li> <a href="./try.php?meigen_id={$meigen['meigen_id']}"><img src="../img/bt_wakatta.png" alt="雰囲気わかりました"></a> </li>
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