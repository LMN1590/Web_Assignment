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
  <title>Quản lý bình luận của tin tức</title>
</head>
<body>

  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/admin/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
    <form method="post" action="newCommmentManagement.php">
      <!--<a href="memberManagement.php"><input type="button" class="p-3 mb-2 bg-primary bg-gradient text-white" name="display" value="Hiển thị danh sách thành viên"></a>-->
      <a href="newNewsComment.php"><input type="button" class="p-3 mb-2 bg-primary bg-gradient text-white" value="Thêm bình luận"></a>
    </form>
    <?php
      include('../config/config.php');
      echo "<table class='table table-bordered'>
              <tr>
                  <th>ID</th>
                  <th>ID người viết bình luận</th>
                  <th>Thời gian</th>
                  <th>Nội dung</th>
                  <th>ID bài viết</th>
                  <th>Xem bài viết chứa bình luận</th>
              </tr>
              <tbody>";
      $sql = "SELECT * from news_comments";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $user_id = $row['user_id'];
          $datetime = $row['datetime'];
          $content = $row['content'];
          $content = mysqli_real_escape_string($conn, $content);
          $news_id = $row['news_id'];
          echo "<tr>
                  <td>" . $id . "</td>
                  <td>" . $user_id . "</td>
                  <td>" . $datetime . "</td>
                  <td>" . $content . "</td>
                  <td>" . $news_id . "</td>
                  <td>
                      <a href='../newsInfo.php?news_id=$news_id'
                        class='btn btn-primary m-r-1em' name='edit'>Xem</a>
                  </td>
                </tr>";
        }
        echo "</tbody></table>";
      }
    ?>
</body>
</html>