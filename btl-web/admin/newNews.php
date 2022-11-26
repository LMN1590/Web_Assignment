<?php
  if($_POST){
    // include database connection
    include ('../config/config.php');

    try {
      $name = $_POST['name'];
      $datetime = $_POST['datetime'];
      $content = $_POST['content'];

      $query2 = "INSERT INTO news (name, datetime, content) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($query2);

      $stmt->bind_param('sss', $name, $datetime, $content);
      $stmt->execute();
      if ($_POST['submit'])
      {
        echo "<script>window.location.href='newsManagement.php'; alert('Tạo bài viết mới thành công!')</script>";
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
  <title>Thêm bài viết</title>
</head>
<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Thêm bài viết</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>Tên bài viết</td>
          <td><input type='text' name='name' class='form-control' required></td>
        </tr>
        <tr>
          <td>Ngày & giờ đăng bài viết</td>
          <td><input type='datetime-local' name='datetime' class='form-control' required></td>
        </tr>
        <tr>
          <td>Nội dung bài viết</td>
          <td><input type='textarea' name='content' class='form-control' required></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type='submit' name='submit' value='Lưu' class='btn btn-primary' />
            <a href='newsManagement.php' class='btn btn-danger'>Quay lại bảng bài viết</a>
          </td>
        </tr>
      </table>
    </form>
  </div> 
  <!-- end .container -->
</body>
</html>