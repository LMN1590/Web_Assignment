<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome CDN-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
  <!-- jQuery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- jsdelivr CDN / Sweet Alert2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="admin-styles/styles.css">
  <title>Bảng điều khiển của Admin</title>
</head>
<body>
  <?php 
    session_start();
    if ($_SESSION['admin']) {
      $id = $_SESSION['user_id'];
      $username = $_SESSION['username'];
    } 
    else {
      header('Location: ../login.php');
    }
  ?>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/admin/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
    <a href="memberManagement.php" style="text-decoration: none"><div class="p-3 mb-2 bg-primary bg-gradient text-white">Quản lý thành viên</div></a>
    <a href="productManagement.php" style="text-decoration: none"><div class="p-3 mb-2 bg-secondary bg-gradient text-white">Quản lý sản phẩm</div></a>
    <a href="newsManagement.php" style="text-decoration: none"><div class="p-3 mb-2 bg-success bg-gradient text-white">Quản lý tin tức</div></a>
    <a href="productCommentManagement.php" style="text-decoration: none"><div class="p-3 mb-2 bg-danger bg-gradient text-white">Quản lý bình luận của sản phẩm</div></a>
    <a href="newsCommentManagement.php" style="text-decoration: none"><div class="p-3 mb-2 bg-info bg-gradient text-white">Quản lý bình luận của tin tức</div></a>
</body>
</html>