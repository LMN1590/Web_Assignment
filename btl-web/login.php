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
  <link rel="stylesheet" href="styles/form.css">
  <title>Đăng nhập tài khoản</title>
</head>

<body>
  <!-- Start Nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- End Nav bar --> 
  <!-- Start retrieving data -->
  <?php
    require_once('config/config.php');
    if (session_id() === "")
    {
      session_start();
    }
    if (isset($_POST['login'])) {
      $username =   $_POST['username'];
      $username =   mysqli_real_escape_string($conn, $username);
      $password =   $_POST['password'];
      $password =   mysqli_real_escape_string($conn, $password);

      $query    = "SELECT * FROM `user` WHERE username='" . $username . "' AND password='" . $password . "'";
      $result = $conn->query($query);
      $tmp = $result->fetch_assoc();
      $rows = $result->num_rows;
      if ($rows == 1) {
        $id = $tmp['id'];
        $admin = $tmp['admin'];
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = $admin;
        header('location: index.php');
        mysqli_free_result($result);
      } else {
        echo "<script>
                Swal.fire({
                  icon: 'warning',
                  title: 'Sai username và/hoặc mật khẩu!',
                  text: 'Vui lòng đăng nhập lại!'
                })
              </script>";
      }
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
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Đăng Nhập</h3>

              <form action="" method="post" class="px-md-2">
                <div class="form-outline mb-4">
                  <label class="form-label" for="username" required>Username</label>
                  <input type="text" name="username" id="username" class="form-control"/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="password" required>Mật khẩu</label>
                  <input type="password" name="password" id="password" class="form-control"/>
                </div>
                  <p class="text-center text-muted mt-5 mb-0">Chưa có tài khoản? <a href="register.php" class="fw-bold text-body"><u>Hãy đăng ký</u></a></p><br>
                <div style="display: flex; align-items: center; justify-content: center">
                  <button type="submit" name="login" class="btn btn-success btn-lg mb-1" style="background-color: #ff7f50">Đăng Nhập</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Register Form -->
</body>
</html>