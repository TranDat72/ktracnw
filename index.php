<?php 

  session_start();
  require_once('config/dbhelper.php');
  $src = ""; 
  if (isset($_SESSION['username'])) {
    $check = "select trangthai from user where taikhoan = '".$_SESSION['username']."'" ;

    $check = select_one($check);
    if ($check != null) {
        $status = $check['trangthai'];
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <div class="wrapper">
        <section>
            <header>
                <div id="inner-header">
                    <a class="logo" href="#">ĐH Thuỷ Lợi</a>
                    <nav>
                        <ul id="main-menu">
                            <li><a href="">Trang chủ</a></li>
                            <li><a href="../login/login.php">Đăng nhập</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class="clearfix"></div>
        </section>
        <br><br><br><br>
        
        <section class="content">
            <div class="pp">
            <h2>Danh sách các cán bộ trường ĐH Thuỷ Lợi</h2>
            <br>
            <form action="" method="GET">
            <?php 
                if (isset($_GET['search'])) {
                $search= $_GET['search'];
                $src = " where name like '%".$search."%' ";
                }
                else{
                    $search="";
                    $src = " where name like '%".$search."%'  ";

                }
            ?>
                <input type="search" value='<?=$search?>' name="search" placeholder="Nhập tên Cán bộ ....">
                <input type="submit" class="btn">
            </form>
            <br> <br>
            <?php 

 
                $sql= "select * from canbo ".$src."";
        

                    $datas = select_list($sql);


        ?>
            <div class="container">
            <?php 

                foreach( $datas as $data){

            ?>
                <a class="a" href="detail.php?id=<?=$data['id']?>">
                    <div class="item">
                        <img src="<?php echo"".$data['anh']."" ?>" alt="">
                        
                        <p><?php echo"".$data['name']."" ?></p>
                    </div>
                </a>
                <?php } ?>
            </div>
            </div>
           
        </section>
    </div>
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop()) {
                    $('header').addClass('sticky');
                }
                else {
                    $('header').removeClass('sticky');
                }
            })
        }
        )
    </script>
</body>
</html>