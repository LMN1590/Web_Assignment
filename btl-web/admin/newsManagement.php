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
  <!-- Bootstrap CDN-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="admin-styles/styles.css">
  <title>Quản lý tin tức</title>
</head>
<body>

  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/admin/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
    <form method="post" action="newsManagement.php">
      <a href="newNews.php"><input type="button" class="p-3 mb-2 bg-primary bg-gradient text-white" value="Thêm tin tức"></a>
    </form>
    <?php
      include('../config/config.php');
      echo "<table class='table table-bordered'>
              <tr>
                  <th>ID</th>
                  <th>Tên bài viết</th>
                  <th>Ngày giờ đăng bài</th>
                  <th>Nội dung bài viết</th>
              </tr>
              <tbody>";
      $sql = "SELECT * from news";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $name = $row['name'];
          $datetime = $row['datetime'];
          $datetime = substr($datetime, 0, 10) . "T" . substr($datetime, 11);
          $content = $row['content'];
          echo "<tr>
                  <td>" . $id . "</td>
                  <td>" . $name . "</td>
                  <td>" . $datetime . "</td>
                  <td>" . $content . "</td>
                  <td>
                    <a href='editNews.php?id=$id&name=$name&datetime=$datetime&content=$content' class='btn btn-primary m-r-1em' name='edit'>Sửa</a>
                    <a href='deleteNews.php?id=$id' class='btn btn-danger'>Xóa</a>
                    <a href='../newsInfo.php?id=$id' class='btn btn-success'>Xem</a>
                  </td>
                </tr>";
        }
        echo "</tbody></table>";
      }
    ?>
</body>
</html>