<?php
    require_once('config/config.php');
    //select data
    $query = "SELECT * FROM news ORDER BY datetime DESC";
    $res = mysqli_query($conn, $query);
    $news = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row_cnt = $res->num_rows;
    mysqli_free_result($res);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
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
  <link rel="stylesheet" href="styles/news.css">
  <title>Tin tức</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar -->
  <!--Main layout-->
  <div class="site-cata height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <div class="search">
          </div>     
        </div>
  </div>
<div class="container">
  <!--Section: News of the day-->
  <section class="border-bottom pb-4 mb-5">
    <div class="row gx-5">
      <div class="col-md-6 mb-4">
        <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
          <a href="newsInfo.php?news_id=<?php echo htmlspecialchars($news[0]['id']); ?>">
          <img src="img/latest-news.png" class="img-fluid" />
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <a href="newsInfo.php?news_id=<?php echo htmlspecialchars($news[0]['id']); ?>" class="minitext">
              <span class="badge bg-danger px-2 py-1 shadow-1-strong mb-3">Tin mới nhất</span>
              <h4><strong><?php echo $news[0]['name'];?></strong></h4>
              <div class="col-6">
                    <u> <?php echo $news[0]['datetime'];?></u>
                  </div>
              <p class="text-muted">
                <?php echo $news[0]['content'];?>
              </p>
        </a>
        
      </div>
    </div>
  </section>
  <!--Section: News of the day-->

  <!--Section: Content-->
  <section>
    
    <div class="row gx-lg-5">
    <?php for($j=1; $j<count($news);$j++)
      {?>
      <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
        <!-- News block -->
        <div>
          <!-- Featured image -->
          <div class="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4"
            data-mdb-ripple-color="light">
            <img src="" class="img-fluid" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </a>
          </div>
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
              <u> <?php echo $news[$j]['datetime'];?></u>
            </div>
          </div>

          <!-- Article title and description -->
          <a href="newsInfo.php?news_id=<?php echo htmlspecialchars($news[$j]['id']); ?>" class="text-dark minitext">
            <h5><?php echo $news[$j]['name'];?></h5>
            <p>
            <?php echo $news[$j]['content'];?>
            </p>
          </a>

          <hr />
        </div>
        <!-- News block -->
      </div>
      <?php }?>
      </div>
  </div>
  </section>
  <!--Section: Content-->

</div>
<!--Main layout-->
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");?>
  </div>
  <!-- end footer --> 
  
</body>
</html>