<?php
require('../libs/database.php');
$objDb = new db_util();
$graves = $objDb->select("SELECT * FROM graves");

?>

<!DOCTYPE html>
<html class="no_js" lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="">
    <link type="text/css" rel="stylesheet" href="/css/main.css" />
    <title>名言くん（仮）</title>
</head>

<body>
<div class="container">

    <div class="navbar">
        <div class="navbar-header">
            <div class="navbar-brand">
                <a href="/meigen/index.html">名言くん</a>
            </div>
            <div class="navbar-entry"><a href="#">投稿する</a></div>
        </div>
    </div>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav">
            <li><a href="/meigen/work.html">RANKING</a></li>
            <li><a href="/meigen/about.html">CALLENDER</a></li>
            <li><a href="/meigen/blog.html">SHINIKAKE</a></li>
            <li><a href="/bochi/">BOCHI</a></li>
        </ul>
    </div>
    <div id="graves-list">
    <table>
        <tr>
            <td>名言</td>
            <td>発言者</td>
            <td>投稿者</td>
            <td>犯人</td>
            <td>犯行時刻</td>
            <td>道連れ数</td>
        </tr>
        <?php
        if (count($graves) > 0) {
            foreach($graves as $grave) {
        ?>
            <tr>
                <td><?php echo $grave['meigen_text'] ?></td>
                <td><?php echo $grave['speaker'] ?></td>
                <td><?php echo $grave['contributor'] ?></td>
                <td><?php echo $grave['killer'] ?></td>
                <td><?php echo $grave['created_at'] ?></td>
                <td><?php echo $grave['together'] ?></td>
            </tr>
        <?php

            }
        } else {
        ?>
            <td colspan="6">墓は空のようだ</td>
        <?php
        }
        ?>
    </table>
    </div>
	<a href="../meigen/meigen.php">めいげん</a>
</body>

</html>


