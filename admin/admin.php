
<?php
require_once ('../config/dbhelper.php');
  session_start();
    $check = "select trangthai from user where taikhoan = '".$_SESSION['username']."'" ;

 	$check = select_one($check);
 	if ($check != null) {
 		$status = $check['trangthai'];
 	}
    if (!isset($_SESSION["username"]) || $status == 0 )
        {     header("Location:../../index.php");
        }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#">Adminstrator</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="admin.php">All</a></li>
                    <li class="nav-item"><a class="nav-link" href="unit.php">Unit</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="add.php">Add</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page lanidng-page">
    <form style="width:40%" class="d-xl-flex justify-content-xl-center">
    <?php 
                $id = "";
                $wh = "";
            if (isset($_GET['search'])) {
            $search= $_GET['search'];
            $wh = " where name like '%".$search."%' ";
            }
            else{
                $search="";
                $wh = " where name like '%".$search."%'  ";

            }
                ?>
        <input type="search" placeholder="Search" name="search" class="border rounded-pill form-control" />
        <button class="btn btn-primary" type="submit">Button</button>
    </form>
        <section class="portfolio-block block-intro">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Họ Tên</th>
                            <th>Ảnh</th>
                            <th>Chức vụ</th>
                            <th>Email</th>
                            <th>SDT</th>
                            <th>Đơn vị</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php


if (isset($_GET['id_donvi'])) {
    $id = $_GET['id_donvi'];
    if ($id =='') {
        $wh = 'where id_donvi' .$id;
    }else{
        $id = "=".$_GET['id_donvi'];
        $wh = 'where id_donvi' .$id;
    }
}



$sql  = 'select * from canbo '.$wh;

$listcanbo = select_list($sql);


foreach ($listcanbo as $item) {
    
        $donvi = "select name from donvi where id = " .$item['id_donvi'];
        $val_donvi = select_one($donvi);
        if ($val_donvi != null) {
                $item_donvi = $val_donvi['name'];
        }


    
    echo '<tr>
                    <td>'.$item['name'].'</td>
                    <td><img height="100px" src='.$item["anh"].' alt=""></td>
                    <td>'.$item['chucvu'].'</td>
                    <td>'.$item['email'].'</td>
                    <td>'.$item['sdt'].'</td>
                    <td>'.$item_donvi.'</td>
                    <td><button class="btn btn-primary" onclick="deleteCategory('.$item['id'].')" type="button">Xoá</button></td>
                    <td><a href="add.php?id='.$item['id'].'"><button class="btn btn-primary" type="button">Sửa</button></a></td>
                    </tr>';
                    }
                    ?>
                        
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">About me</a><a href="#">Contact me</a><a href="#">Projects</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script type="text/javascript">
		function deleteCategory(id) {
			var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('delete.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}


	</script>
</body>

</html>