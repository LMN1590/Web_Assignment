<?php
  require_once('config/config.php');
  //select data
  $content = $_GET['content'];
  $query = "SELECT * FROM news WHERE name LIKE '%".$content."%' ORDER BY id";
  $res = mysqli_query($conn, $query);
  $newslist = mysqli_fetch_all($res, MYSQLI_ASSOC);
?> 

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
  <link rel="stylesheet" href="styles/product-style.css">
  <title>Tin tức</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <div class="displayProd ">
      <div class=" site-cata news-cata height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <div class="search">
            <form method="post" action="index.php">
              <i class="fa fa-search"></i>
              <input type="text" name="input-search" class="form-control" placeholder="Tìm kiếm tin tức">
              <input type="submit" class="form-control btn btn-primary" name="news-search" value="Tìm kiếm">
            </form>
          </div>     
        </div>
      </div>
      <div class="container">
        <div class="justify-content-center align-items-center">
          <?php
            if (mysqli_num_rows($res) == 0){
              echo "<div class='alert alert-danger'>No records found.</div>";
            }
            foreach ($newslist as $news) {
          ?>
          <div class="mt-3 mb-3">
            
            <!-- Article data -->
            <div class="row mb-3">
              <div class="col-6">
                <a href="" class="text-info minitext">
                <img class="rounded-circle shadow-1-strong me-3 d-inline-block align-top"
                  src="img/logo.png" alt="avatar" width="24"
                  height="24" />Admin
                </a>
              </div>
  
              <div class="col-6 text-end minitext">
                <u> <?php echo $news['datetime'];?></u>
              </div>
            </div>
  
            <!-- Article title and description -->
            <a href="newsInfo.php?news_id=<?php echo htmlspecialchars($news['id']); ?>" class="text-dark minitext link">
              <h5><?php echo $news['name'];?></h5>
              <p>
              <?php echo $news['content'];?>
              </p>
            </a>
  
            <hr />
          </div>
      </div>
        <?php 
          }
          mysqli_close($conn);
        ?>
        
      </div>
  </div>
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"];
    include($IPATH."\\footer.php");?>
  </div>
  <!-- end footer -->
</body>
</html>

