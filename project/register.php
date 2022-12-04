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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="styles/form.css">
  <title>Đăng ký tài khoản</title>
</head>
<body>
  <!-- Start Nav bar --> 
  <div>
      <?php 
        $IPATH = $_SERVER["DOCUMENT_ROOT"];
        include($IPATH."\\navbar.php");
      ?>
  </div>
  <!-- End Nav bar -->  
  <!-- Start retrieving data -->
  <?php
    require_once('config/config.php');
    if (isset($_POST['register'])) {
      $username =   $_POST['username'];
      $username =   mysqli_real_escape_string($conn, $username);

      $find = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$username'");
      $rows = mysqli_num_rows($find);

      if ($rows == 0) {
        $password =   $_POST['password'];
        $password =   mysqli_real_escape_string($conn, $password);
        $full_name =  $_POST['fullname'];
        $full_name =  mysqli_real_escape_string($conn, $full_name);
        $birthday =   $_POST['birthday'];
        $birthday =   mysqli_real_escape_string($conn, $birthday);
        $sex =        $_POST['sex'];
        $sex =        mysqli_real_escape_string($conn, $sex);
        $email =      $_POST['email'];
        $email =      mysqli_real_escape_string($conn, $email);
        $phone =      $_POST['phone'];
        $phone =      mysqli_real_escape_string($conn, $phone);
        $address =    $_POST['address'];
        $address =    mysqli_real_escape_string($conn, $address);
        
        if (!preg_match("/^[0-9a-zA-Z-'.,()*!áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $username) ||
            !preg_match("/^[a-zA-Z-'áàảãạăắặẳâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựđÁÀẢÃẠĂẮẶẲÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰĐ ]*$/", $full_name) ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !preg_match("/^[0-9+()]*$/", $phone)
        ) {
          echo "<div class='alert alert-danger'>Input invalid</div>";
        }
        else {
          $query = "INSERT INTO `user` (username, password, full_name, sex, birthday, email, phone, address) VALUES ('$username','$password','$full_name', '$sex', '$birthday','$email','$phone','$address')";
          $result = mysqli_query($conn, $query);
          if ($result) {
            echo "<script>
                    Swal.fire({
                      icon: 'success',
                      title: 'Đăng ký tài khoản thành công!',
                      confirmButtonColor: '#ff7f50',
                      footer: '<a href=login.php>Nhấn vào đây để đăng nhập</a>'
                    })
                  </script>";
          } else {
            echo "<script>
                    Swal.fire({
                      icon: 'warning',
                      title: 'Lỗi',
                      text: 'Đã xảy ra lỗi!'
                    })
                  </script>";
          }
          //mysqli_free_result($result);
        }
        //mysqli_free_result($result);
      } 
      else {
        echo "<script>
                Swal.fire({
                  icon: 'warning',
                  title: 'Tài khoản đã tồn tại!',
                  text: 'Vui lòng thử lại!'
                })
              </script>";
      }
      mysqli_free_result($find);
    }
    mysqli_close($conn);
  ?>
  <!-- End retrieving data -->

  <!-- Start Register Form -->
  <div class="h-100 h-custom my-container-log">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card rounded-3">
            <img src="img/reg-img/regform.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Đăng Ký</h3>
              <form action="" method="post" class="px-md-2">
                <div class="form-outline mb-4">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="password" required>Mật khẩu</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="fullname">Họ & tên</label>
                  <input type="text" name="fullname" id="fullname" class="form-control" required>
                  <div class="error" style="color: red;"></div>
                </div>
                <div class="form-outline mb-4">
                  <label for="sex" class="form-label">Giới tính:</label>
                  <select class="select" name="sex" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                  </select>
                </div>
                <div class="form-outline mb-4">
                  <div class="form-outline datepicker">
                    <label for="birthday" class="form-label">Sinh nhật</label>
                    <input type="date" name="birthday" class="form-control" min="1912-01-01" max="2012-12-31" required>
                  </div>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="email" required>Email</label>
                  <input type="email" name="email" id="email" class="form-control"/>
                  <div class="error" style="color: red;"></div>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="phone" required>Số điện thoại</label>
                  <input type="text" name="phone" id="phone" class="form-control"/>
                  <div class="error" style="color: red;"></div>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="address" required>Địa chỉ</label>
                  <input type="text" name="address" id="address" class="form-control"/>
                  <div class="error" style="color: red;"></div>
                </div>
                <p class="text-center text-muted mt-5 mb-0">Đã có tài khoản? <a href="login.php"
                    class="fw-bold text-body"><u>Hãy đăng nhập</u></a></p><br>
                <div style="display: flex; align-items: center; justify-content: center">
                  <button type="submit" name="register" class="btn btn-success btn-lg mb-1" style="background-color: #ff7f50">Đăng Ký</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Register Form -->
  <script src="js/formValidation.js"></script>
</body>
</html>
