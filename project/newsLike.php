

<?php
    require_once('config/config.php');
    $cmtID=intval($_GET['cmtID']);
    $query = "SELECT * FROM `news_comments` WHERE id = '" . $cmtID . "'";
    $res = mysqli_query($conn, $query);
    $cmt = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $changeCur = $cmt[0];
    $insQuery = "UPDATE `news_comments` SET `num_like`=? WHERE id = '" . $cmtID . "'";
    $stmt = $conn->prepare($insQuery);
    $curLike=intval(intval($changeCur['num_like'])+1);
    $stmt->bind_param('i', $curLike);
    $stmt->execute();
    echo $curLike;
?>