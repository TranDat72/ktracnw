<?php
    require_once ('config/dbhelper.php');	

  
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
	
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
                            <li><a href="login.php">Đăng nhập</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class="clearfix"></div>
        </section>
        <br><br><br><br>
        <?php 

        $sql =  " select * from canbo where id =".$_GET['id']." ";

        $directory =  select_one($sql) ;
        if($directory != null) {
        
                $name = $directory['name'];
                $thumbnail = $directory['anh'];
                $cv = $directory['chucvu'];

                $em = $directory['email'];
                $sdt = $directory['sdt'];
                $dtcq = $directory['coquan'];
                $iddv = $directory['id_donvi'];

                $sqldv = "select name from donvi where id = " .$iddv;
                $iddv = select_one($sqldv) ;
        if ($iddv!= null) {
                $dv = $iddv['name'];
        }


        }  ?>
        <section class="detail">
                <h1>Thông tin</h1>
                <div class="info">
                    <div class="grid">
                        <img src="<?=$thumbnail?>" alt="">
                    </div>
                    <div class="grid">
                        <p><strong>Chuc vu :</strong><?=$cv?></p>
                        <p><strong>Don vi :</strong><?=$dv?></p>
                        <p><strong>Email :</strong><?=$em?></p>
                        <p><strong>Số ĐT :</strong><?=$sdt?></p>
                        <p><strong>Số ĐT cơ quan :</strong><?=$dtcq?></p>
                    </div>
                </div>
        </section>
</body>
</html>