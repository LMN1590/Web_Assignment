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
  <link rel="stylesheet" href="../styles/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Charis+SIL&display=swap" rel="stylesheet">
  <title>Giới thiệu</title>
</head>

<style>
  td li{
    width:125px;
  }
</style>
<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");?>
  </div>
  <!-- end nav bar --> 
  <div class="height d-flex justify-content-center align-items-center" style="
  background-image: url(img/site-name/about-page.jpg);
  background-repeat: no-repeat;
  background-position: center;
  padding: 9% 8%;
  background-size: cover;
  max-width: 100%;
  height: 300px;
  border-bottom: var(--border);">
        <div class="col-md-8">
          <div class="search">
          </div>     
        </div>
      </div>
  <!-- main content --> 
  <div class="row my-container container-fluid justify-content-center" style=" font-size: 20px">
    <div class="col-sm-7">
    <h4><br>Về chúng tôi</h4><p>
    Nếu bạn đang tìm kiếm một hương vị ẩm thực độc đáo, một sự kết hợp hoàn hảo giữa ẩm thực Nhật Bản và 
    những biến tấu đầy nghệ thuật thì thực đơn tại TramkamVL sẽ là một trải nghiệm đáng giá. Tại TramkamVL, chúng tôi 
    kế thừa và tiếp tục phát triển phong cách ẩm thực của bậc thầy sushi hàng đầu trong nghệ thuật sử dụng bột ngọt Hảo Hảo - 
    Lê Minh Nghãi. Những món ăn Nhật Bản truyền thống giờ đây được thêm thắt những giá trị ẩm thực mới, mang đến sự bùng nổ 
    về hương vị kèm theo sự mới lạ khi thưởng thức. 
    </p><hr>
    <h4>Bậc thầy Lê Minh Nghãi</h4><p>
    <img src="img/nghia.png" width="400" height="400" alt="logo">
    <ul>
      <li>Phục vụ ẩm thực Nhật</li>
      <li>Rèn luyện kinh nghiệm Quản trị nhà hàng</li>
      <li>Cầu nối giao lưu của con người văn hóa</li>
      <li>Ngôi nhà của mọi tín ngưỡng</li>
      <li>Phương châm hướng đến "Chân - Thiện - Mỹ"</li>
    </ul>
    </p><hr>
    <h4>Các thông tin khác</h4><p>
    <table style="margin-left: 10px">
        <ul>
        <tr>
          <td><li>Tên</li></td>
          <td>: Nhà hàng TramkamVL</li></td>
        </tr>
        <tr>
          <td><li>Trụ sở</li></td>
          <td>: 268 Lý Thường Kiệt, phường 14, quận 10, TP.HCM</li></td>
        </tr>
        <tr>
          <td><li>Điện thoại</li></td>
          <td>: (+84)028 3823 3824</li></td>
        </tr>
        <tr>
          <td><li>Website</li></td>
          <td>: *nhà hàng nghèo khổ giữa mùa đông lạnh giá không có tiền mua domain*</li></td>
        </tr>
        <tr>
          <td><li>Email</li></td>
          <td>: leminhnghai@gmail.com</li></td>
        </tr>
        </ul>
    </table><hr>
    
    </div>
    <div class="col-sm-5" style="padding: 0 20px 0 10px; margin-top: 10px">
    <div class="row">
      <br><br>
    </div>
      <div class="row" style="font-weight: bold; font-size: 30px; display: flex; justify-content: center; align-items: center; font-family: 'Charis SIL', serif;">
        HỖ TRỢ TRỰC TUYẾN
      </div>
      <div class="row" style="font-size: 20px; background-color: #2ed573; border: 1px solid black; display: flex">
        <p style="padding-top: 10px"><i class="fa fa-phone"> Mr. Danh: (+84)938 469 314</i><br>
        <i class="fa fa-phone"> Mr. Nghĩa: (+84)901 561 789</i>
      </p>
      </div>
      <div class="row" style="font-size: 20px; background-color: #ffa502; border: 1px solid black; display: flex">
        <p style="padding-top: 10px"><i class="fas fa-envelope"> Mr. Danh: danh@hcmut.edu.vn</i><br>
        <i class="fas fa-envelope"> Mr. Nghĩa: nghia@hcmut.edu.vn</i>
      </p>
      </div>
    </div>
  </div>
  <!-- end main content --> 

  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");?>
  </div>
  <!-- end footer --> 
</body>
</html>