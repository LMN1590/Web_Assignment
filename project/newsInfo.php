
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
  <link rel="stylesheet" href="styles/news-info.css">
  <title>Tin tức</title>
</head>
<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <?php
    require_once('config/config.php');
    //select data
    $news_id = "";
    if (isset($_GET['news_id'])) {
      $news_id = $_GET['news_id'];
    }
    $query = "SELECT * FROM news WHERE id = '" . $news_id . "'";
    $res = mysqli_query($conn, $query);
    $newspage = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row_cnt = $res->num_rows;
    $newspage1 = $newspage[0];

    $query1 = "SELECT * FROM news_comments WHERE news_id = '" . $news_id . "'";
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
      $news_id = $_POST['news_id'];
      $news_id = mysqli_real_escape_string($conn, $news_id);
      $num_like = 0;
      $query = "INSERT INTO `news_comments` (user_id, datetime, content, news_id, num_like) VALUES ('$user_id',now(),'$content', '$news_id', '$num_like')";
      $res = mysqli_query($conn, $query);
      if ($res) {
        header('location: newsInfo.php?news_id=' . $news_id);
      }
      //mysqli_free_result($res);
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
  <div id="container">
    <div class="newsDISP" style="padding: 1em 0 0 2em; background-color: #e9d993;">
        <div class="mb-3 text-white">
            <h1 style="font-size: 50px; color:black;"><?php echo htmlspecialchars($newspage1['name']); ?></h1>
        </div>
        <p class="lead text-white">
          <span class="text-white">
            <h5  style="color:black;"><?php echo htmlspecialchars($newspage1['datetime']); ?></h5>
          </span>
        </p>
        </div>
        <div class="row">
          <div class="col-sm-7" style="border: 1px solid black; padding: 1em 2em 0 2em; margin: 1em 2em 0 2em; font-size: 20px">
          <p><?php echo htmlspecialchars($newspage1['content']); ?></p>
          <p><?php echo htmlspecialchars($newspage1['contentBody']); ?></p>
          </div>
          <div class="col-sm-4" style="padding: 0 20px 0 10px; margin-top: 10px">
    <div class="row">
      <br><br>
    </div>
      <div class="row" style="font-weight: bold; font-size: 30px; display: flex; justify-content: center; align-items: center; font-family: 'Charis SIL', serif;">
        HỖ TRỢ TRỰC TUYẾN
      </div>
      <div class="row" style="font-size: 20px; background-color: #2ed573; border: 1px solid black; display: flex">
        <p style="padding-top: 10px"><i class="fa fa-phone"> Mr. Danh: (+84)938 469 314</i><br>
        <i class="fa fa-phone"> Mr. Nghĩa: (+84)901 561 789</i>
      </p>
      </div>
      <div class="row" style="font-size: 20px; background-color: #ffa502; border: 1px solid black; display: flex">
        <p style="padding-top: 10px"><i class="fas fa-envelope"> Mr. Danh: danh@hcmut.edu.vn</i><br>
        <i class="fas fa-envelope"> Mr. Nghĩa: nghia@hcmut.edu.vn</i>
      </p>
      </div>
    </div>
        </div>

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
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
                ?> 
                <div class="card-header py-3 border-0" style="background-color: #f8f9fa;">
                  <form action="" method="post">
                    <div class="d-flex flex-start w-100">
                      <img class="rounded-circle shadow-1-strong me-3"
                        src="img/nghia-ava.png" alt="avatar" width="40"
                        height="40" />
                      <div class="form-outline w-100">
                        <textarea class="form-control" id="textAreaExample" rows="4"
                          style="background: #fff; resize: none;" placeholder="Bình luận mới" name="comment_text"></textarea>
                        <!-- <label class="form-label" for="textAreaExample">Bình luận</label> -->
                      </div>
                    </div>
                    <div class="float-end mt-2 pt-1">
                      <input type="hidden" name="news_id" value="<?php echo $news_id ?>"></input>
                      <button type="submit" class="btn-orange btn btn-primary btn-sm" name="comment_post">Đăng</button>
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
                  if (isset($_SESSION['admin']) == false) {
                    foreach($cmts as $comment) {
                ?>
                <div class="card-body">
                  <div class="d-flex flex-start align-items-center">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="img/nghia-ava.png" alt="avatar" width="60"
                      height="60" />
                    <div>
                      <h6 class="fw-bold text-primary mb-1">
                        <?php 
                          $key = array_search($comment['user_id'], array_column($users, 'id'));
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
                </div>
                <?php      
                    }
                  }
                  else if ($_SESSION['admin'] == 1){
                    foreach($cmts as $comment){
                ?>
                <div class="card-body">
                  <div class="d-flex flex-start align-items-center">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="img/nghia-ava.png" alt="avatar" width="60"
                      height="60" />
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
                  <a href=<?php echo "admin/deleteNewsComment.php?id=$id&news_id=$news_id"?> class="d-flex align-items-center me-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <p class="mb-0">Xóa</p>
                    </a>
                    </a>
                  </div>
                </div>
                <?php 
                    }
                  }
                    else
                    {
                      foreach($cmts as $comment){
                  ?>
                <!--cmt-->
                <div class="card-body">
                  <div class="d-flex flex-start align-items-center">
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="img/nghia-ava.png" alt="avatar" width="60"
                      height="60" />
                    <div>
                      <h6 class="fw-bold text-primary mb-1">
                        <?php 
                          $key = array_search($comment['user_id'], array_column($users, 'id'));
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
                <?php 
                      }  
                      
                }
                ?>
                <!--cmt-->
              </div>
            </div>
          </div>
        </div>
    </div>
    <script>
      function change(id){
        console.log(id);
        $.ajax({
            url:"newsLike.php",
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
      mysqli_close($conn);
    ?>
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\footer.php");?>
  </div>
  <!-- end footer --> 
</body>
</html>
