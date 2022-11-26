<?php
  if($_POST){
    // include database connection
    include ('../config/config.php');

    try {
      $name = test_input($_POST['name']);
      $description = test_input($_POST['description']);
      $price = test_input($_POST['price']);
      $img_path = test_input("img/product-list/" . $_POST['img_path']);
      $status = test_input($_POST['status']);

      if (!preg_match("/^[0-9a-zA-Z-'.,()*!<>:\/áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $name) ||
          !preg_match("/^[0-9,.]*$/", $price) ||
          !preg_match('/\.(jpg|png|jpeg)$/', $img_path) ||
          !preg_match("/^[0-1]*$/", $status)) {
        echo "<div class='alert alert-danger'>Input không hợp lệ!</div>";
      }
      else {
        $query2 = "INSERT INTO product (name, description, price, img_path, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query2);
  
        $stmt->bind_param('ssisi', $name, $description, $price, $img_path, $status);
        $stmt->execute();
        if ($_POST['submit']) {
          echo "<script>window.location.href='productManagement.php'; alert('Tạo sản phẩm mới thành công!')</script>";
        }
        move_uploaded_file($_POST['img_path'], '../img/product-list/' . $_POST['img_path']);
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
  <title>Thêm sản phẩm</title>
  <script src="../js/checkPicturesInput.js" defer></script>
</head>
<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Thêm sản phẩm</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>Tên sản phẩm</td>
          <td><input type="text" name='name' class='form-control' required></td>
        </tr>
        <tr>
          <td>Mô tả sản phẩm</td>
          <td><input type='text' name='description' class='form-control' required></td>
        </tr>
        <tr>
          <td>Giá</td>
          <td><input type='number' name='price' class='form-control' required></td>
        </tr>
        <tr>
          <td>Hình ảnh sản phẩm</td>
          <td><input type='file' name="img_path" class='form-control' onchange="ValidateSingleInput(this);" required accept=".png, .jpg, .jpeg, .gif"></td>
        </tr>
        <tr>
          <td>Trạng thái (0: hết hàng, 1: còn hàng)</td>
          <td><input type='number' name='status' class='form-control' required></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type='submit' name='submit' value='Lưu' class='btn btn-primary' />
            <a href='productManagement.php' class='btn btn-danger'>Quay lại bảng sản phẩm</a>
          </td>
        </tr>
      </table>
    </form>
  </div> 
  <!-- end .container -->
</body>
</html>