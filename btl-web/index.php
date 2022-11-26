<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Font Awesome CDN-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
  <!-- jQuery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- jsdelivr CDN / Sweet Alert2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap CDN-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="styles/styles.css">
  <title>Trang chủ</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <!-- main content --> 
  <div class="main-content">
    <div class=" food-search height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <div class="search">
            <form method="post" action="index.php">
              <i class="fa fa-search"></i>
              <input type="text" name="input-search" class="form-control" placeholder="Bạn đang thèm gì?">
              <input type="submit" class="form-control btn btn-primary" name="submit-search" value="Tìm kiếm">
            </form>
          </div>
        </div>
    </div>
    <div class="container-img">
      <h1 class="text-center">KHÁM PHÁ DANH MỤC SẢN PHẨM<br><br></h1>        
      <div class="row justify-content-center">
        <div class="col-3">
          <a href="productInfo.php?prod_id=4">
            <img src="img/food-img/ramen-cata.jpg" alt="" class="img-fluid img-curve">
          </a>
        </div>
        <div class="col-3">
          <a href="productInfo.php?prod_id=5">
            <img src="img/food-img/sushi-cata.jpg" alt="" class="img-fluid img-curve">
          </a>
        </div>
        <div class="col-3">
          <a href="productInfo.php?prod_id=3">
            <img src="img/food-img/beverage-cata.jpg" alt="" class="img-fluid img-curve">
          </a>
        </div>
        <div class="col-3">
          <a href="productInfo.php?prod_id=2">
            <img src="img/food-img/rice-cata.jpg" alt="" class="img-fluid img-curve">
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- end .main-content -->    
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");?>
  </div>
  <!-- end footer --> 
</body>
</html>

<?php
  if (isset($_POST["submit-search"]))
  {
    $temp = $_POST["input-search"];
    echo "<script>window.location.href = 'productsListSearch.php?content=$temp';</script>";
  }
?>
