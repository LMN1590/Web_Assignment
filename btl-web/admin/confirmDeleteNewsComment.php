<?php
    include '../config/config.php';
    $id = $_GET['id'];
    $news_id = $_GET['news_id'];
    $query4 = "DELETE FROM news_comments WHERE id = ?";
    $stmt = $conn->prepare($query4);
    $stmt->bind_param('s', $id);
    if($stmt->execute())
    {
        echo "<script>window.location.href = '../newsInfo.php?news_id=$news_id';</script>";
    }
    else die('Unable to delete record.');
?>