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
  
    require_once("database.php");
    require_once("conf.php");
    require_once("session.php");
?>
