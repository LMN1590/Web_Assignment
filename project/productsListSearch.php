
<?php
  //initialize sessions
  session_start();

  require_once('config/config.php');
  //select data
  $query = "SELECT * FROM product ORDER BY id";
  $res = mysqli_query($conn, $query);
  $row_cnt = $res->num_rows;
  mysqli_free_result($res);

  $content = $_GET['content'];
  $query = "SELECT * FROM product WHERE name LIKE '%".$content."%' ORDER BY id";
  $stmt = mysqli_query($conn, $query);
  $food = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
  

  //Load up session for cart
  if ( !isset($_SESSION["cart"]) ) {
    $_SESSION["cart"] = array(-1);
    for ($i=0; $i< $row_cnt; $i++) {
      $_SESSION["quantity"][$i] = 0;
    }
  }
  //Add
  if ( isset($_GET["add"]) ) {
    if (isset($_SESSION['user_id'])) {
      $id = $_GET["add"];
      if (!in_array($id, $_SESSION["cart"])) {
        array_push($_SESSION["cart"], $id);
      }
      $_SESSION["quantity"][$id] = $_SESSION["quantity"][$id] + 1;
      header("Location:productsList.php");
      exit();
    }
    else {
      header("Location:login.php");
      exit();
    }
  }
?> 
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
  <link rel="stylesheet" href="styles/product-style.css">
  <title>Sản phẩm</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <div class="displayProd ">
      <div class=" site-cata height d-flex justify-content-center align-items-center">
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
      <div class="content justify-content-center align-items-center row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
        <?php
          if (mysqli_num_rows($stmt) == 0){
            echo "<div class='alert alert-danger'>No records found.</div>";
          }
          foreach ($food as $dish) {
        ?>
        <div class="card p-3 card-custom">
          <div class="top-div" href="productInfo.php?prod_id=<?php echo htmlspecialchars($dish['id']);?>">
              <div class="border">
              <img src="<?php echo htmlspecialchars($dish['img_path']); ?>">
              </div>
              <span style="width: auto; padding: 0 10px 0 10px"><?php echo htmlspecialchars($dish['price']); ?>K</span>
              <a href="productInfo.php?prod_id=<?php echo htmlspecialchars($dish['id']);?>" class="stretched-link"></a>
          </div>
          <div class="bottom-div" href="productInfo.php?prod_id=<?php echo htmlspecialchars($dish['id']);?>">
              <h3><?php echo htmlspecialchars($dish['name']); ?></h3>
              <p><?php echo htmlspecialchars($dish['description']); ?></p>
                <a class="btn btn-custom" href="?add=<?php echo(htmlspecialchars($dish['id'])); ?>">Thêm ngay</a>
          </div>
          <div class="last-section">
              <div class="last-div">
                <i class="fa fa-comment-o"></i>
              </div>
          </div>
        </div>
        <?php 
          }
          mysqli_close($conn);
        ?>
        
      </div>
  </div>
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\footer.php");?>
  </div>
  <!-- end footer -->
</body>
</html>

