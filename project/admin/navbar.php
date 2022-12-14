<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="admin-styles/adminButton.css">
    <title>ADMIN DASHBOARD</title>
</head>
<body>
  <nav class="my-navbar navbar navbar-expand-xl navbar-dark bg">
    <!-- Container wrapper -->
    <div class="my-container container-fluid">
      <a class="navbar-brand" href="index.php">
        <div class="container">
          <div class="row">
            <div class="col-6"><img src="../img/logo.png" width="120" height="120" style="border-radius:100%;" class="d-inline-block align-top" alt="logo"></div>
            <div class="col-6" style="padding:45px;"><b>BẢNG ĐIỀU KHIỂN CỦA ADMIN</b></div>
          </div>
          
        </div>
      </a>
      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->

        <!-- Notifications -->
        
        <!-- Avatar -->
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../img/logo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1">Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="../">Trở lại trang chủ</a></li>
            <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
          </ul>
        </div>
      </div>
      <!-- End Right elements -->
    </div>
    <!-- End Container wrapper -->
  </nav>
</body>
</html>