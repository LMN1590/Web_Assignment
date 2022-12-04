<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome CDN-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
  <!-- jQuery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- jsdelivr CDN / Sweet Alert2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="admin-styles/styles.css">
  <title>Admin Panel</title>
  <style>
    .pass{
      max-width: 25px;
      word-break: break-all;
    }
    .full{
      min-width: 100px;
      line-break: normal;
      word-break: keep-all;
    }
    .mail{
      max-width: 300px;
      line-break: anywhere;
    }
    .addr{
      max-width: 300px;
      line-break: normal;
    }
    .btnn{
      min-width: 150px;
    }
  </style>
</head>
<body>

  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/admin/";
    include($IPATH."\\navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <form method="post" action="memberManagement.php">
    <a href="index.php"><input type="button" class="p-3 mb-2 bg-gray bg-gradient text-black" value="Trở lại"></a>
    <a href="newMember.php"><input type="button" class="p-3 mb-2 bg-primary bg-gradient text-white" value="Thêm thành viên"></a>
  </form>
  <div class="container">
    <?php
      include('../config/config.php');
      echo "<table class='table table-bordered'>
              <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Mật khẩu</th>
                  <th>Họ & tên</th>
                  <th>Giới tính</th>
                  <th>Sinh nhật</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Phím tắt</th>
              </tr>
              <tbody>";
      $sql = "SELECT * from user";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $username = $row['username'];
          $password = $row['password'];
          $full_name = $row['full_name'];
          $seggs = $row['sex'];
          $birthday = $row['birthday'];
          $email = $row['email'];
          $phone = $row['phone'];
          $address = $row['address'];
          echo "<tr>
                  <td class=\"id\">" . $id . "</td>
                  <td class=\"usr\">" . $username . "</td>
                  <td class=\"pass\">" . $password . "</td>
                  <td class=\"full\">" . $full_name . "</td>
                  <td class=\"xx\">" . $seggs . "</td>
                  <td class=\"bir\">" . $birthday . "</td>
                  <td class=\"mail\">" . $email . "</td>
                  <td class=\"phone\">" . $phone . "</td>
                  <td class=\"addr\">" . $address . "</td>
                  <td class=\"btnn\">
                    <a href='editMember.php?id=$id' class='btn btn-primary m-r-1em' name='edit'>Sửa</a>
                    <a href='deleteMember.php?id=$id' class='btn btn-danger'>Xóa</a>
                  </td>
                </tr>";
        }
        echo "</tbody></table>";
      }
    ?>
  </div>
  
</body>
</html>