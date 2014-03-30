<?php
require('../libs/core.php');

$meigen_id = isset($_REQUEST['meigen_id']) ? $_REQUEST['meigen_id'] : 1;  
if(!ctype_digit($meigen_id)) {
    echo '数字を入力してください';
    exit();
}

// iotw登録処理
$result = insertIotwData($meigen_id);
exit();

/**
 * IOTW登録
 */
function insertIotwData($meigen_id) {
    $objDb = new db_util();
    
    $meigen_id_post = $meigen_id;
    //$member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] :1;
    $member_id = 2; /* FIX: test用コード（認証系実装完了後に修正） */ 
    $add_date = date("Y-m-d H:i:s");
    $addParams = array(
        "meigen_id"   => intval($meigen_id_post),
        "member_id"   => intval($member_id),
        "created_at"  => $add_date,
        "modified_at" => $add_date,
    );
       
    $result = $objDb->insert("iotws", $addParams);

    return $result;
}
?>