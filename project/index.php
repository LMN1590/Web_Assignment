
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
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <!-- main content --> 
  <div class="main-content">
    <div class=" food-search height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <div class="search">
            <form method="post" action="index.php">
              <i class="fa fa-search"></i>
              <input type="text" name="input-search" class="form-control" placeholder="Bạn đang tìm kiếm gì?">
              <input type="submit" class="form-control btn btn-primary" name="submit-search" value="Tìm kiếm">
            </form>
          </div>
        </div>
    </div>
    <div class="container-img">
      <h1 class="text-center">KHÁM PHÁ DANH MỤC SẢN PHẨM<br><br></h1>        
      <div class="row justify-content-center">
        <?php
          require_once('config/config.php');
          //select data
          $query = "SELECT * FROM product ORDER BY id";
          $res = mysqli_query($conn, $query);
          $food = mysqli_fetch_all($res, MYSQLI_ASSOC);
          $row_cnt = $res->num_rows;
          mysqli_free_result($res);
          if ($row_cnt == 0){
            echo "<div class='alert alert-danger'>No records found.</div>";
          }
          for ($i = 0; $i < 4;$i++) {
        ?>
        <div class="col-3" style="height:400px;">
          <a href="productInfo.php?prod_id=<?php echo htmlspecialchars($food[$i]['id']);?>">
            <img style="height:100%;" src="<?php echo htmlspecialchars($food[$i]['img_path']); ?>" alt="" class="img-fluid img-curve">
          </a>
        </div>
        <?php 
          }
          mysqli_close($conn);
        ?>
      </div>
    </div>
  </div>
  <!-- end .main-content -->    
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\footer.php");?>
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
  if (isset($_POST["news-search"]))
  {
    $temp = $_POST["input-search"];
    echo "<script>window.location.href = 'newsListSearch.php?content=$temp';</script>";
  }
?>
