<?php
  //initialize sessions
    session_start();

  require_once('config/config.php');
  //select data
  $query = "SELECT * FROM product ORDER BY id";
  $res = mysqli_query($conn, $query);
  $food = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $row_cnt = $res->num_rows;
  mysqli_free_result($res);

  //Load up session for cart
  if ( !isset($_SESSION["cart"]) ) {
    $_SESSION["cart"] = array(-1);
    for ($i=0; $i< $row_cnt; $i++) {
      $_SESSION["quantity"][$i] = 0;
    }
  }

  //Add
  if ( isset($_GET["add"]) ) {
    $id = $_GET["add"];
    if (!in_array($id, $_SESSION["cart"])) {
      array_push($_SESSION["cart"], $id);
    }
    $_SESSION["quantity"][$id] = $_SESSION["quantity"][$id] + 1;
    header('location: productInfo.php?prod_id=' . $_POST['prod_id']);
    exit();
  }
?> 

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
  <link rel="stylesheet" href="styles/productInfo-style.css">
  <title>Thông tin món ăn</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <?php
    require_once('config/config.php');
    //select data
    $prod_id = "";
    if (isset($_POST['prod_id'])) {
      $prod_id = $_POST['prod_id'];
    }
    elseif(isset($_GET['prod_id'])){
      $prod_id = $_GET['prod_id'];
    }
    $query = "SELECT * FROM product WHERE id = '" . $prod_id . "'";
    $res = mysqli_query($conn, $query);
    $dish = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row_cnt = $res->num_rows;
    $dish1 = $dish[0];

    $query1 = "SELECT * FROM prod_comments WHERE prod_id = '" . $prod_id . "'";
    $res = mysqli_query($conn, $query1);
    $cmts = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $cmt_cnt = $res->num_rows;

    $query2 = "SELECT id, username FROM user";
    $res = mysqli_query($conn, $query2);
    $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_free_result($res);
    if ($row_cnt == 0){
      echo "<div class='alert alert-danger'>No records found.</div>";
    }
    if (isset($_POST['comment_post']) && isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $user_id = mysqli_real_escape_string($conn, $user_id);
      $content = $_POST['comment_text'];
      $content = mysqli_real_escape_string($conn, $content);
      $prod_id = $_POST['prod_id'];
      $prod_id = mysqli_real_escape_string($conn, $prod_id);
      $num_like=0;
      $query = "INSERT INTO `prod_comments` (user_id, datetime, content, prod_id,num_like) VALUES ('$user_id',now(),'$content', '$prod_id','$num_like')";
      $res = mysqli_query($conn, $query);
      if ($res) {
        header('location: productInfo.php?prod_id=' . $prod_id);
        exit();
      }
      mysqli_free_result($res);
    }
    else if (isset($_POST['comment_post'])) {
      echo "<script>
              Swal.fire({
                icon: 'warning',
                title: 'Bạn cần đăng nhập để có thể viết bình luận!',
                confirmButtonColor: '#ff7f50',
                footer: '<a href=login.php>Nhấn vào đây để đăng nhập</a>'
              })
            </script>";
    }
  ?>
  <main class="">
    <div class="container dark-grey-text">

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-6 mb-4" style="display: flex; align-items: center; justify-content: center">
          <img src="<?php echo htmlspecialchars($dish1['img_path']); ?>" class="img-fluid" alt="">
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
                <h1><?php echo htmlspecialchars($dish1['name']); ?></h1>
            </div>

            <p class="lead">
              <span><h4>Giá:</h4><?php echo htmlspecialchars($dish1['price']);?>000 VND</span>
            </p>

            <p class="lead font-weight-bold"><h5>Miêu tả:</h5></p>

            <p><?php echo htmlspecialchars($dish1['description']); ?></p>

            <p>
              <h5>Tình trạng:</h5>
              <?php
                if ($dish1['status'] == 1) {
                  echo '<p class="stat-ok">Còn hàng</p>';
                }
                else {
                  echo '<p class="stat-fail">Hết hàng</p>';
                }
              ?>
            </p>              
            <a class="btn btn-dark" href="?add=<?php echo (htmlspecialchars($dish1['id'])); ?>">Thêm ngay</a>
            <a href="productsList.php" class="btn btn-success">Trở về Danh mục sản phẩm</a>
            
            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <!-- <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px"> -->
              <!-- <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart -->
              <!-- <i class="fas fa-shopping-cart ml-1"></i> -->
              <!-- </button> -->
            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center commentDISP">

        <!--Grid column-->
        <div class="col-md-6 text-center">
          <h4 class="my-4 h4">Phần bình luận</h4>
        </div>
        <!--Grid column-->
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card">
              <?php if ($_SESSION['admin'] == 0) {
              ?>
              <div class="card-header py-3 border-0" style="background-color: #f8f9fa;">
                <form id="cmt" action="productInfo.php" method="post">
                  <div class="d-flex flex-start w-100">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="img/logo.png" alt="avatar" width="40"
                      height="40" />
                    <div class="form-outline w-100">
                      <textarea class="form-control" id="textAreaExample" rows="4"
                        style="background: #fff; resize: none;" placeholder="Bình luận mới" name="comment_text"></textarea>
                      <!-- <label class="form-label" for="textAreaExample">Bình luận</label> -->
                    </div>
                  </div>
                  <div class="float-end mt-2 pt-1">
                    <input type="hidden" name="prod_id" value="<?php echo $prod_id ?>"></input>
                    <button form="cmt" type="submit" class="btn-orange btn btn-primary btn-sm" name="comment_post" value="commentin">Đăng</button>
                    <input type="reset" class="btn-orange-out btn btn-outline-primary btn-sm" value="Hủy"></input>
                  </div>
                </form>
              </div>
              <?php }
              ?>
              <?php 
                if($cmt_cnt == 0)
                {
                  echo "Chưa có bình luận nào";
                }
                if (isset($_SESSION['admin']) == false);
                else if ($_SESSION['admin'] == 1){
                  foreach($cmts as $comment){
              ?>
              <div class="card-body">
                <div class="d-flex flex-start align-items-center">
                  <img class="rounded-circle shadow-1-strong me-3" src="img/logo.png" alt="avatar" width="60" height="60" />
                  <div>
                    <h6 class="fw-bold text-primary mb-1">
                      <?php 
                        $key = array_search($comment['user_id'], array_column($users, 'id'));
                        $id = $comment['id'];
                        echo $users[$key]['username'];
                      ?>
                    </h6>
                    <p class="text-muted small mb-0">
                      <?php echo $comment['datetime'];?>
                    </p>
                  </div>
                </div>
                <p class="mt-3 mb-4 pb-2">
                  <?php echo htmlspecialchars($comment['content']);?>
                </p>
                <div class="small d-flex justify-content-start">
                  <a href=<?php echo "admin/deleteProductComment.php?id=$id&prod_id=$prod_id"?> class="d-flex align-items-center me-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <p class="mb-0">Xóa</p>
                  </a>
                </div>
              </div>
                <?php
                    }
                  mysqli_close($conn);
                }
                  else
                  {
                    foreach($cmts as $comment){
                ?>
              <!--cmt-->
              <div class="card-body">
                <div class="d-flex flex-start align-items-center">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="img/logo.png" alt="avatar" width="60"
                    height="60" />
                  <div>
                    <h6 class="fw-bold text-primary mb-1">
                      <?php $key = array_search($comment['user_id'], array_column($users, 'id')); 
                      echo ($users[$key]['username']);
                      ?>
                    </h6>
                    <p class="text-muted small mb-0">
                      <?php echo $comment['datetime'];?>
                    </p>
                  </div>
                </div>

                <p class="mt-3 mb-4 pb-2">
                  <?php echo htmlspecialchars($comment['content']);?>
                </p>

                <div class="small d-flex justify-content-start">
                    <a href="#!" class="d-flex align-items-center me-3">
                      <div class="far fa-thumbs-up me-2 Add_Numlike" onclick="change(<?php echo $comment['id']?>)"></div>
                      <p class="mb-0" id="L<?php echo $comment['id']?>"  ><?php echo $comment['num_like'] . " Thích" ;?></p>
                    </a>
                    <a href="#!" class="d-flex align-items-center me-3">
                      <i class="far fa-comment-dots me-2"></i>
                      <p class="mb-0">Bình luận</p>
                    </a>
                    <a href="#!" class="d-flex align-items-center me-3">
                      <i class="fas fa-share me-2"></i>
                      <p class="mb-0">Chia sẻ</p>
                    </a>
                  </div>
              </div>
              <script>
                function change(id){
                  console.log(id);
                  $.ajax({
                      url:"productsLike.php",
                      data:{
                        cmtID:String(id)
                      },
                      type:"get",
                      success: function(data,status){
                          $("#L"+String(id)).text(data+" Thích");
                      }
                  });
                }
              </script>
              <?php 
                }
                mysqli_close($conn);
              }
              ?>
              <!--cmt-->
            </div>
          </div>
        </div>
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");?>
  </div>
  <!-- end footer --> 
</body>
</html>