<?php
  if (session_id() === "") {
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="styles/header.css">
</head>
<body>
  <nav class="my-navbar-logo navbar navbar-expand-xl navbar-dark bg-dark">
      <div class="my-container container-fluid justify-content-center">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo-name.png" width="120" height="120" class="d-inline-block align-top" alt="">
        </a>
      </div>
  </nav>    
  <nav class="my-navbar navbar navbar-expand-xl navbar-dark bg-dark">
  <div class="col-sm-3"></div>
  <div class="col-sm-6" style="text-align: center">
    <div class="my-container container-fluid justify-content-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon justify-content-center"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar" style="font-size: 20px">
          <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php">&nbsp;&nbsp;Trang chủ&nbsp;&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">&nbsp;&nbsp;Giới thiệu&nbsp;&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="productsList.php">&nbsp;&nbsp;Sản phẩm&nbsp;&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="newsList.php">&nbsp;&nbsp;Tin tức&nbsp;&nbsp;</a>
              </li>
          </ul>
      </div>
    </div>
  </div>
      <!-- Icon dropdown -->
      <?php if (isset($_SESSION['user_id'])) { ?>
      <div class="dropdown col-sm-3">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="justify-content: right; align-items: right; padding-right: 15px">
            <img src="img/logo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['username'];?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="editProfile.php?id=<?php echo $_SESSION['user_id']; ?>">Chỉnh sửa thông tin</a></li> 
              <?php
                if ($_SESSION['admin']) echo "<li><a class='dropdown-item' href='admin/index.php'>Bảng điều khiển của Admin</a></li>";
              ?>
              <!-- <li><a class="dropdown-item" href="#">Cài đặt</a></li> -->
              <!-- <li><a class="dropdown-item" href="profile.php">Tài khoản</a></li> -->
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
          </ul>
      </div>

      <?php }
      else { ?>
      <div class="dropdown user-drop col-sm-3">
        <div style="position: absolute; right: 0; bottom: 0; margin-bottom: -20px; margin-right: 10px">
          <button type="button" class="user-btn btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
          <i class="fas fa-user-circle"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            <li><a class="dropdown-item" href="register.php">Đăng ký</a></li>
            <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
          </ul>
        </div>
      </div>
      <?php } ?>  
  </nav>
</body>
</html>