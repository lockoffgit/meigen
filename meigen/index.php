<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>TOP - 名言くん</title>
</head>

<body>
<?php
    require_once("../libs/database.php");
    define("LIST_MAX", 10);
    $objDb = new db_util();
    $query = "
        SELECT 
            Mei.*, COUNT(Iot.iotw_id) AS iotw_cnt, COUNT(Del.delete_id) AS delete_cnt
            COALESCE(Mei.image_url, Mem.image_url) AS meigen_image_url

        FROM meigens AS Mei
        
        LEFT JOIN members AS Mem
        ON Mem.member_id = Mei.member_id
        
        LEFT JOIN iotws AS Iot
        ON Iot.meigen_id = Mei.meigen_id
        
        LEFT JOIN deletes AS Del
        ON Del.meigen_id = Mei.meigen_id
        
        WHERE Mem.del_flag <> 1

        GROUP BY Iot.meigen_id , Del.meigen_id

        LIMIT ?, ".LIST_MAX."
    ";
    $page_no = $_GET['page_no'] ? ($_GET['page_no'] - 1) * LIST_MAX : 0;
    $params[] = $page_no;
    $arrMeigens = $objDb->select($query, $params);
    
    foreach($arrMeigens as $meigens){
?>
    <div class="meigens">
        <img src="<?php echo $meigens['meigen_image_url']; ?>" width="100%" />
        <p><?php echo date("Y.m.d", $meigens['created_at']); ?></p>
        <p><?php echo $meigens['speaker']; ?></p>
        <p><a href="./try.php?meigen_id=<?php $meigens['meigen_id']; ?>">だいたいわかりました</a></p>
    </div>
<?php
    }   // foreach
?>

    <a href="../meigen/">めいげん</a>
</body>

</html>