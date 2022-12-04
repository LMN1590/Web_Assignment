<?php
    include '../config/config.php';
    $id = $_GET['id'];
    $prod_id = $_GET['prod_id'];
    $query4 = "DELETE FROM prod_comments WHERE id = ?";
    $stmt = $conn->prepare($query4);
    $stmt->bind_param('s', $id);
    if($stmt->execute())
    {
        echo "<script>window.location.href = '../productInfo.php?prod_id=$prod_id';</script>";
    }
    else die('Unable to delete record.');
?>