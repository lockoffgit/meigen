<?php
    require_once("../libs/core.php");
    $objDb = new db_util();
    $page_no = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
    $arrMeigens = $objDb->getMeigenList($page_no);
    if(count($arrMeigens) > 0){
        foreach($arrMeigens as $meigen){
            $return .= <<<EOF
    <div class="meigen">
	<div class="meigen-area">
		<div class="meigen-photo"><img src="/images/member/{$meigen['member_id']}.jpg"></div>
		<div class="meigen-txt">
		  	<div class="meigen-detail">
			<p>{$meigen['meigen_text']}</p>
			<p>
                            {$meigens['speaker']}<br>
				<span class="day">
                                    {$meigens['created_at']}
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
			<a href="./detail.php?meigen_id={$meigen['meigen_id']}"><img src="../img/3.jpg" alt="雰囲気わかりました"></a>
		</li>
	    </ul>
	</div>
    </div><!-- /meigen -->
EOF;
        }
    echo $return;
    }else{
        echo '<div id="no_more">これ以上ありませんよ</div>';
    }
?>