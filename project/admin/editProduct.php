<?php
  if ($_POST) {
    // include database connection
    include ('../config/config.php');
    try {
      // // insert query
      $id = test_input($_GET['id']);
      $name = test_input($_POST['name']);
      $description = test_input($_POST['description']);
      $price = test_input($_POST['price']);
      $img_path = "img/product-list/" . $_FILES['img_path']['name'];
      $status = test_input($_POST['status']);

      if (!preg_match("/^[0-9a-zA-Z-'.,()*!<>:\/áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $name) ||
          !preg_match("/^[0-9,.]*$/", $price) ||
          !preg_match("/^[0-1]*$/", $status)) {
        echo "<div class='alert alert-danger'>Input không hợp lệ!</div>";
      }
      else {
        $query3 = "UPDATE product SET name = ?, description = ?, price = ?, img_path = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($query3);
        $tmp = $_POST['img_path_pre'];
        
        if ($img_path == "img/product-list/")
          $stmt->bind_param('ssisii', $name, $description, $price, $tmp, $status, $id);
        else $stmt->bind_param('ssisii', $name, $description, $price, $img_path, $status, $id);
        $stmt->execute();
        move_uploaded_file($_FILES['img_path']['tmp_name'], '../img/product-list/' . $_FILES['img_path']['name']);

        if ($_POST['submit']) {
          if ($img_path == "img/product-list/")
            echo "<script>window.location.href='editProduct.php?id=$id'; alert('Chỉnh sửa thành công!')</script>";
          else echo "<script>window.location.href='editProduct.php?id=$id'; alert('Chỉnh sửa thành công!')</script>";
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
    .container { margin: 0 auto; }
  </style>
  <title>Sửa thông tin sản phẩm</title>
  <script src="../js/checkPicturesInput.js" defer></script>
</head>
<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Sửa thông tin sản phẩm</h1>
    </div>
    <?php
      require_once('../config/config.php');
      $id = '';
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      } 
      $query = "SELECT * FROM product WHERE id = " . $id;
      $res = mysqli_query($conn, $query);
      $products = mysqli_fetch_all($res, MYSQLI_ASSOC);
      $product = $products[0];
      mysqli_free_result($res);
    ?>
    <form method="post" enctype="multipart/form-data">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>ID</td>
          <td><input type='text' name='id' class='form-control' value="<?php echo $product['id']?>" disabled></td>
          <tr>
          <td>Tên sản phẩm</td>
          <td><input type='text' name='name' class='form-control' value="<?php echo $product['name']?>" required></td>
        </tr>
        <tr>
          <td>Mô tả sản phẩm</td>
          <td><input type='text' name='description' class='form-control' value="<?php echo $product['description']?>" required></td>
        </tr>
        <tr>
          <td>Giá</td>
          <td><input type='number' name='price' class='form-control' value="<?php echo $product['price']?>" required></td>
        </tr>
        <tr>
          <td>Hình ảnh mới sản phẩm<br>(để trống nếu không thay đổi)</td>
          
          <td>
          <input type="hidden" name="img_path_pre" value="<?php echo $product['img_path']?>">
            <input type="file" name="img_path" class='form-control' value="<?php echo $product['img_path']?>" onchange="ValidateSingleInput(this);" accept=".png, .jpg, .jpeg, .gif">
          </td>
        </tr>
        <tr>
          <td>Trạng thái (0: hết hàng, 1: còn hàng)</td>
          <td><input type='number' name='status' class='form-control' value="<?php echo $product['status']?>" required></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type='submit' name='submit' value='Lưu' class='btn btn-primary' />
            <a href='productManagement.php' class='btn btn-danger'>Quay lại bảng sản phẩm</a>
          </td>
        </tr>
    </form>
  </div> 
  <!-- end .container -->
</body>
</html>