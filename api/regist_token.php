<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../libs/core.php');

$reg_id = $_REQUEST['regId'];  

if (empty($reg_id)) {
    exit;
}

$result = isDeviceToken($reg_id);
if ($result === false) {
    insertDeviceToken($reg_id);
}

print('save ok');
exit();


/**
 * DeviceToken存在確認
 * @param type $reg_id
 * @return type
 */
function insertDeviceToken($reg_id) {
    $objDb = new db_util();
    
    $reg_id_post = $reg_id;
    $add_date = date("Y-m-d H:i:s");
    $addParams = array(
        "device_token_id" => (string)$reg_id_post,
        "created_at"  => $add_date,
        "modified_at" => $add_date,
    );

    $result = $objDb->insert("deviceTokens", $addParams);
    
    return $result;
}

/**
 * DeviceToken登録処理
 * @param type $reg_id
 * @return boolean
 */
function isDeviceToken($reg_id) {
    $objDb = new db_util();
    $sql = "select count(*) as count from deviceTokens where device_token_id = ?";
    $result = $objDb->select($sql, array($reg_id));
    
    $is_device_token = false;
    if ($result[0]['count'] > 0) {
        $is_device_token = true;
    }

    return $is_device_token;
}