<?php
  if($_POST){
    // include database connection
    include ('../config/config.php');

    try {
      $username = test_input($_POST['username']);
      $password = test_input($_POST['password']);
      $fullname = test_input($_POST['full_name']);
      $sex = test_input($_POST['sex']);
      $birthday = test_input($_POST['birthday']);
      $email = test_input($_POST['email']);
      $phone = test_input($_POST['phone']);
      $address = test_input($_POST['address']);

      if (!preg_match("/^[0-9a-zA-Z-'.,()*!áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $username) ||
          !preg_match("/^[a-zA-Z-'áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $fullname) ||
          !filter_var($email, FILTER_VALIDATE_EMAIL) ||
          !preg_match("/^[0-9+]*$/", $phone)
      ) {
        echo "<div class='alert alert-danger'>Input không hợp lệ!</div>";
      }
      else {
        $query2 = "INSERT INTO user (username, password, full_name, sex, birthday, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";;
        $stmt = $conn->prepare($query2);
  
        $stmt->bind_param('ssssssss', $username, $password, $fullname,
        $sex, $birthday, $email, $phone, $address);
        $stmt->execute();
        if ($_POST['submit']) {
          echo "<script>window.location.href='memberManagement.php'; alert('Tạo thành viên mới thành công!')</script>";
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
  <title>Thêm thành viên</title>
</head>
<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Thêm thành viên</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>Username</td>
          <td><input type='text' name='username' class='form-control' required></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type='text' name='password' class='form-control' required></td>
        </tr>
        <tr>
          <td>Họ & tên</td>
          <td><input type='text' name='full_name' class='form-control' required></td>
        </tr>
        <tr>
          <td>Giới tính</td>
          <td>
            <select class="select" name="sex" required>
              <option value="Nam">Nam</option>
              <option value="Nữ">Nữ</option>
              <option value="Khác">Khác</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Sinh nhật</td>
          <td><input type='date' name='birthday' class='form-control' min="1912-01-01" max="2012-12-31" required></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type='email' name='email' class='form-control' required></td>
        </tr>
        <tr>
          <td>Số điện thoại</td>
          <td><input type='text' name='phone' class='form-control' required></td>
        </tr>
        <tr>
          <td>Địa chỉ</td>
          <td><input type='text' name='address' class='form-control' required></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type='submit' name='submit' value='Lưu' class='btn btn-primary' />
            <a href='memberManagement.php' class='btn btn-danger'>Quay lại bảng thành viên</a>
          </td>
        </tr>
      </table>
    </form>
  </div> 
  <!-- end .container -->
</body>
</html>