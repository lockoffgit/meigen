<?php
require('../libs/core.php');

$meigen_id = isset($_REQUEST['meigen_id']) ? $_REQUEST['meigen_id'] : 1;
if(!ctype_digit($meigen_id)) {
    echo '数字を入力してください';
    exit();
}
// iotw登録処理
$delete_result = insertDeleteData($meigen_id);

// 名言詳細情報を取得
$arrMeigens = getMeigenData($meigen_id);


// 削除件数がLIFE数を上回った場合は墓場処理を実施
if ($arrMeigens['delete_cnt'] >= MEIGEN_DELETE_LIFE
        && count($arrMeigens) > 0) {
    $grave_result = insertGraveData($arrMeigens);
    $meigen_result = deleteMeigens($meigen_id);
}

exit(); // とりあえずはトランザクションは考えない

/**
 * IOTW登録
 */
function insertDeleteData($meigen_id) {
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
       
    $result = $objDb->insert("deletes", $addParams);

    return $result;
}

/**
 * 墓場テーブル挿入
 */
function insertGraveData($arrMeigens) {
    $objDb = new db_util();
    
    $add_date = date("Y-m-d H:i:s");
    $addParams = array(
        "meigen_text"  => $arrMeigens['meigen_text'],
        "speaker"      => $arrMeigens['speaker'],
        "contributor"  => $arrMeigens['contributor'],
        "killer"       => 2, /* FIX: test用コード（認証系実装完了後に修正） */ 
        "together"     => intval($arrMeigens['tries_cnt']),
        "created_at"   => $add_date,
        "modified_at"  => $add_date
    );
    $result = $objDb->insert("graves", $addParams);

    return $result;
}

/**
 * 名言データ詳細取得処理
 */
function getMeigenData($meigen_id) {
    $objDb = new db_util();        
    $result = $objDb->getMeigenData($meigen_id);

    return $result;
}

/**
 * 削除カウントを取得
 */
function deleteMeigens($meigen_id) {
    $objDb = new db_util();
    $query = 'DELETE FROM meigens WHERE meigen_id = ?';
    $result = $objDb->query($query, array($meigen_id));

    return $result;
}

?>