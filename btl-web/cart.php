<?php
    //initialize sessions
    session_start();

    require_once('config/config.php');
    //select data
    $query = "SELECT * FROM product ORDER BY id";
    $res = mysqli_query($conn, $query);
    $row_cnt = $res->num_rows;
    mysqli_free_result($res);

    //Load up session for cart
    if ( !isset($_SESSION["cart"]) ) {
        $_SESSION["cart"] = array(-1);
        for ($i=0; $i< $row_cnt; $i++) {
            $_SESSION["quantity"][$i] = 0;
        }
    }

     //Delete
    if ( isset($_GET["delete"]) ) {
        $id = $_GET["delete"];
        $_SESSION["quantity"][$id] = 0;
        $index = array_search($id, $_SESSION["cart"]);
        unset($_SESSION["cart"][$index]);
        header("Location:cart.php");
        exit();
    }

    //Reset
    if ( isset($_GET["reset"]) ) {
        if ($_GET["reset"] == 'true') {
            unset($_SESSION["quantity"]); //The quantity for each product
            unset($_SESSION["total"]); //The total cost
            unset($_SESSION["cart"]); //Which item has been chosen
        }
        header("Location:cart.php");
        exit();
    }

    //Update
    if ( isset($_GET["update"]) ) {
        foreach ($_SESSION["cart"] as $key=>$id) {
            echo $id." ".array_key_exists($id,$_SESSION["quantity"]).'<br>';
            if ($key != 0) {
                $_SESSION["quantity"][$id] = $_GET[$id];
            }
        }
        echo var_dump( $_SESSION["quantity"]);
        header("Location: cart.php");
    }

    //Payment
    if ( isset($_GET["pay"]) ) {
        if ($_GET["pay"] == 'true') {
            unset($_SESSION["quantity"]);
            unset($_SESSION["total"]);
            unset($_SESSION["cart"]);
        }
        header("Location:cart.php");
        exit();
    }
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
  <link rel="stylesheet" href="styles/cart.css">
  <title>Giỏ hàng</title>
</head>

<body>
  <!-- nav bar --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."navbar.php");
    $query1 = 'SELECT id, price FROM product where id in ('. implode(",",$_SESSION["cart"]) .') ORDER BY id';
    $res = mysqli_query($conn, $query1);
    $food = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row_cnt = $res->num_rows;
    mysqli_free_result($res);
    $totalCost = 0;
    foreach ($food as $dish) {
        $totalCost = $totalCost + $dish["price"]*$_SESSION["quantity"][$dish["id"]];
    }
    ?>
  </div>
  <!-- end nav bar -->
  <!--Main layout-->
  <div class="site-cata height d-flex justify-content-center align-items-center">
  </div>
  <div class="container" style="min-height: 200px;">
            <div class="row border-bottom border-dark" style="margin-top: 100px;">
                <div class="col-4"><h2>GIỎ HÀNG</h2></div>
                <div class="col-4"><h2>Tổng món: <?php echo htmlspecialchars(count($_SESSION["cart"]) - 1); ?></h2></div>
                <div class="col-4"><h2>Tổng tiền: <?php echo htmlspecialchars($totalCost.'000đ'); ?></h2></div>
            </div>
            <div class="row p-3 border-bottom border-dark">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h4>Tên sản phẩm</h4>
                </div>
                <div class="col-lg-3 col-md-3 col-md-3 col-xs-3 d-flex justify-content-center">
                    <h4>Số lượng</h4>
                </div>
                <div class="col-lg-1 col-md-1 col-md-1 col-xs-1 d-flex justify-content-center">
                    <h4>Giá</h4>
                </div>
                <div class="col-lg-1 col-md-1 col-md-1 col-xs-1 d-flex justify-content-center"></div>
            </div>
            <!-- Product -->
            <form name="form" action="" method="get">
                <?php
                    $query1 = 'SELECT * FROM product where id in ('. implode(",",$_SESSION["cart"]) .') ORDER BY id';
                    $res = mysqli_query($conn, $query1);
                    $food = mysqli_fetch_all($res, MYSQLI_ASSOC);
                    $row_cnt = $res->num_rows;
                    mysqli_free_result($res);
                    if ($row_cnt == 0){
                        echo "<div class='alert alert-danger mt-3'>Giỏ hàng bạn đang trống</div>";
                    }
                    foreach ($food as $dish) {
                ?>
                <div class="row p-3 border-bottom border-dark">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <div class="row">
                            <div class="product-img" style="padding:0px;">
                                <img src="<?php echo htmlspecialchars($dish['img_path']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($dish['name']); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <div class="row">
                            <h5><?php echo htmlspecialchars($dish['name']); ?></h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-md-3 col-xs-3 d-flex justify-content-center">
                        <div class="row" style="width:64px; height:30px;">
                            <input type="number" name="<?php echo htmlspecialchars($dish['id']);?>" aria-label="number-of-product" value="<?php echo $_SESSION["quantity"][$dish['id']]; ?>" min="1" class="form-control p-0 text-center border-dark quantity">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-md-1 col-xs-1 d-flex justify-content-center">
                        <p><?php echo(htmlspecialchars($dish['price'])); ?>000đ</p>
                    </div>
                    <div class="col-lg-1 col-md-1 col-md-1 col-xs-1 ">
                        <a class="btn btn-primary" href="?delete=<?php echo(htmlspecialchars($dish['id'])); ?>">Xóa</a>
                    </div>
                </div>
                <?php 
                    }
                    mysqli_close($conn);
                ?>
             <div class="row">
                <div class="col-6">
                    <div class="mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Ghi chú</label>
                        <textarea class="form-control border-dark" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-center mt-5">
                        <input type="text" name="update" value="true" hidden>
                        <button type="submit" class="btn btn-primary" >Cập nhật</button>
                        <a type="button" class="btn btn-primary" href="?reset=true" style="margin-left:20px;">Xóa bỏ</a>
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary" style="margin-left:20px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Thanh toán
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bạn muốn thanh toán?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Tổng món: <?php echo htmlspecialchars(count($_SESSION["cart"]) - 1);?><br/>
                            Tổng tiền: <?php echo htmlspecialchars($totalCost.'000đ'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <a type="button" class="btn btn-primary" href="?reset=true">Xác nhận</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <!--Main layout-->
        </div>
  <!-- footer --> 
  <div>
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/btl-web/";
    include($IPATH."footer.php");?>
  </div>
  <!-- end footer --> 
  <!-- <script>
    $(document).ready(function() {
        $("#update").click(function(){
            $(".quantity")
        })

    }) -->

  </script>
<body>
</html>