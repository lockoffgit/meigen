<?php
require('../libs/database.php');
$objDb = new db_util();
$graves = $objDb->select("SELECT * FROM graves");

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>ぼち</title>
</head>

<body>

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

