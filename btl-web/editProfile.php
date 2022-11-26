<?php
  // include database connection
  require_once ('config/config.php');
  if ($_POST) {
    try {
      $id = test_input($_GET['id']);
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
          !preg_match("/^[0-9+()]*$/", $phone)
      ) {
        echo "<div class='alert alert-danger'>Input invalid</div>";
      }
      else {
        $query3 = "UPDATE user SET username = ?, password = ?, full_name = ?, sex = ?, birthday = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($query3);

        $stmt->bind_param('sssssssss', $username, $password, $fullname,
        $sex, $birthday, $email, $phone, $address, $id);
        $stmt->execute();
        if ($_POST['submit'])
        {
          echo "<script>alert('Chỉnh sửa thành công!');</script>";
        }
      }
    }   
    // show error
    catch(mysqli_sql_exception $exception){
      die('ERROR: ' . $exception->getMessage());
    }
  }

  $user_id = "";
  if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
  }
  $query = "SELECT * FROM user WHERE id = '" . $user_id . "'";
  $res = mysqli_query($conn, $query);
  $mem = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $mem1 = $mem[0];
  mysqli_free_result($res);
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
  <title>Chỉnh sửa thông tin tài khoản</title>
</head>
<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1>Chỉnh sửa thông tin tài khoản</h1>
    </div>
    <form method="post" onsubmit="return validation()">
      <table class='table table-hover table-responsive table-bordered'>
        <tr>
          <td>ID</td>
          <td><input type='text' name='id' class='form-control' value="<?php echo $mem1['id']?>" disabled></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type='text' name='username' class='form-control' value="<?php echo $mem1['username']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type='text' name='password' class='form-control' value="<?php echo $mem1['password']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td>Họ & tên</td>
          <td><input type='text' name='full_name' class='form-control' value="<?php echo $mem1['full_name']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td>Giới tính</td>
          <td>
            <select class="select" name="sex" required>
              <?php 
              
                if ($mem1['sex'] == 'Nam') 
                  echo "<option value='Nam' selected>Nam</option>
                        <option value='Nữ'>Nữ</option>
                        <option value='Khác'>Khác</option>";
                elseif ($mem1['sex'] == 'Nữ') 
                  echo "<option value='Nam'>Nam</option>
                        <option value='Nữ' selected>Nữ</option>
                        <option value='Khác'>Khác</option>";
                elseif ($mem1['sex'] == 'Khác') 
                  echo "<option value='Nam'>Nam</option>
                        <option value='Nữ'>Nữ</option>
                        <option value='Khác' selected>Khác</option>";
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Sinh nhật</td>
          <td><input type='date' name='birthday' class='form-control' value="<?php echo $mem1['birthday']?>" required></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type='email' name='email' class='form-control' value="<?php echo $mem1['email']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td>Số điện thoại</td>
          <td><input type='text' name='phone' class='form-control' value="<?php echo $mem1['phone']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td>Địa chỉ</td>
          <td><input type='text' name='address' class='form-control' value="<?php echo $mem1['address']?>" required><div class="error" style="color: red;"></div></td>
        </tr>
        <tr>
          <td></td>
          <td>
          <input type='submit' name='submit' value='Lưu' class='btn btn-primary'/>
          <a href='index.php' class='btn btn-danger'>Quay lại trang chủ</a>
          </td>
        </tr>
      </table>
    </form>
  </div> 
  <!-- end .container -->
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");
    mysqli_close($conn);?>
  </div>
  <!-- end footer -->
  <script src="js/formValidation.js"></script>
</body>
</html>