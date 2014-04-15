<?php
    require_once("../libs/core.php");
    
    switch(isset($_REQUEST['mode']) ? $_REQUEST['mode'] : ''){
        case 'list' :
            // ソート内容を決定する
            $session = new session_util();
            $page_no  = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
            $sort_key = isset($_REQUEST['sort'])    ? $_REQUEST['sort']    : '';

            $objDb = new db_util();
            $arrMeigens = $objDb->getMeigenList($page_no, $sort_key);
            $arrMeigens = imageInsert($arrMeigens);
            echo json_encode($arrMeigens);
        break;

        case 'one' :
            $arrMeigen = $objDb->getMeigenData($_REQUEST['meigen_id']);
            $arrMeigen['meigen_image_url'] = 'http://news.utamap.com/_upimg/04400/aa4400_02_0622233106.jpg';
            echo json_decode($arrMeigen);
        break;
    }
    function imageInsert($array){
        foreach($array as $k => $v){
            $array[$k]['meigen_image_url'] = 'http://news.utamap.com/_upimg/04400/aa4400_02_0622233106.jpg';
        }
        return $array;
    }
?>