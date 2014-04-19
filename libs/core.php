<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    define("DB_NAME", "meigen_db");
    define("DB_HOST", "127.0.0.1");
    define("DB_PORT", "3306");
    define("DB_USER", "meigen_user");
    define("DB_PASSWORD", "vwzJ7F4u");
    
    // リスト取得時の取得件数
    define("LIST_MAX", 10);
    // ベースURL
    define("BASE_URL_HTTP", 'http://meigen.do-ing.net/');
    // GCM 通知API　URL
    define("MEIGEN_GCM_API_URL", "https://android.googleapis.com/gcm/send");
    // GCM push通知API　KEY
    define("MEIGEN_GCM_API_KEY", "AIzaSyCFFp7ZSMAYVaAz_MIdFaww-OLkhG3Iwww");

    require_once("database.php");
    require_once("conf.php");
    require_once("gcm.php");
    require_once("session.php");

