<?php
    include '../config/config.php';
    $id = $_GET['id'];
    $query4 = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($query4);
    $stmt->bind_param('s', $id);
    if($stmt->execute())
    {
        header('Location: memberManagement.php');
    }
    else die('Unable to delete record.');
?>
