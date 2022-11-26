<?php
  if($_POST){
    // include database connection
    include ('../config/config.php');

    try {
      $user_id = $_POST['user_id'];
      $datetime = $_POST['datetime'];
      $content = $_POST['content'];
      $prod_id = $_POST['prod_id'];

      if (!preg_match("/^[0-9]*$/", $user_id) || !preg_match("/^[0-9]*$/", $news_id)) {
        echo "<div class='alert alert-danger'>Input không hợp lệ!</div>";
      }
      else {
        $query2 = "INSERT INTO prod_comments (user_id, datetime, content, prod_id) VALUES (?, ?, ?, ?)";;
        $stmt = $conn->prepare($query2);

        $stmt->bind_param('issi', $user_id, $datetime, $content, $prod_id);
        $stmt->execute();
        if ($_POST['submit']) {
          echo "<script>window.location.href='productCommentManagement.php'; alert('Tạo mới bình luận thành công!')</script>";
        }
      }
      mysqli_close($conn);
    }   
    // show error
    catch(mysqli_sql_exception $exception){
      die('ERROR: ' . $exception->getMessage());
    }
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
  <style>
  .container{ margin: 0 auto; }
  </style>
  <title>Thêm bình luận</title>
</head>
<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Thêm bình luận</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>ID người viết bình luận</td>
          <td><input type='number' name='user_id' class='form-control' required></td>
        </tr>
        <tr>
          <td>Thời gian</td>
          <td><input type='datetime-local' name='datetime' class='form-control' required></td>
        </tr>
        <tr>
          <td>Nội dung bình luận</td>
          <td><input type='textarea' name='content' class='form-control' style="resize:none" required></td>
        </tr>
        <tr>
          <td>ID sản phẩm</td>
          <td><input type='number' name='prod_id' class='form-control' required></td>
        </tr>
          <td></td>
          <td>
            <input type='submit' name='submit' value='Lưu' class='btn btn-primary' />
            <a href='productCommentManagement.php' class='btn btn-danger'>Quay lại bảng bình luận sản phẩm</a>
          </td>
        </tr>
      </table>
    </form>
  </div> 
  <!-- end .container -->
</body>
</html>