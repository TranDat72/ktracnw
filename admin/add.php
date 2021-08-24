<?php
	require_once ('../config/dbhelper.php');
    session_start();
     $check = "select trangthai from user where taikhoan = '".$_SESSION['username']."'" ;

 	$check = select_one($check);
 	if ($check != null) {
 		$status = $check['trangthai'];
 	}
    if (!isset($_SESSION["username"]) || $status == 0 )
        {     header("Location:../../admin.php");
            // header("Location:index.php");
        }

$id = $name  = $cv =  $cq =  $em =  $sdt = $bm =  $dv = $anh = $id_dv = '';
if (!empty($_POST)) {
	if (isset($_POST['taikhoan'])) {
		$name = $_POST['taikhoan'];

	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];

	}
		if (isset($_POST['anh'])) {
		$anh = $_POST['anh'];
		$anh = str_replace('"', '\\"', $anh);
	}

	if (isset($_POST['coquan'])) {
		$cq = $_POST['coquan'];
	}
	if (isset($_POST['chucvu'])) {
		$cv = $_POST['chucvu'];
	}
	if (isset($_POST['email'])) {
		$em = $_POST['email'];
	}
	if (isset($_POST['sdt'])) {
		$sdt = $_POST['sdt'];
	}
	
	if (isset($_POST['donvi'])) {
		$dv = $_POST['donvi'];
	}
		

	if (!empty($name)) {
		if ($id == '') {
			
		$sql = 'insert into canbo(name, anh, coquan, chucvu, email, sdt ,id_donvi) values("'.$name.'","'.$anh.'", "'.$cq.'", "'.$cv.'", "'.$em.'", "'.$sdt.'", "'.$dv.'" )';
				
			
		}
		 else {
		$sql = 'update canbo set name = "'.$name.'", anh = "'.$anh.'", coquan = "'.$cq.'", chucvu = "'.$cv.'", email = "'.$em.'", sdt = "'.$sdt.'", id_donvi = "'.$dv.'" where id = '.$id;}
			 select($sql);
			// print($sql);
			// exit();
			header('Location: admin.php');
			die();
		

		
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id']; 
	$sql      = 'select * from canbo where id = '.$id;
	$login = select_one($sql);
	if ($login != null) {
		$name 	  = $login['name'];
		$cq 	  = $login['coquan'];
		$cv 	  = $login['chucvu'];
		$em 	  = $login['email'];
		$sdt 	  = $login['sdt'];
		$id_dv 	  = $login['id_donvi'];
		$anh   = $login['anh'];	

		$donvi = "select name from donvi where id = " .$id_dv;
		$val_donvi = select_one($donvi);
		if ($val_donvi != null) {
				$dv = $val_donvi['name'];
		}
		

	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Hire me - Brand</title>
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
                    <li class="nav-item"><a class="nav-link" href="admin.php">All</a></li>
                    <li class="nav-item"><a class="nav-link" href="unit.php">Unit</a></li>
                    
                    <li class="nav-item"><a class="nav-link active" href="add.php">Add</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page hire-me-page">
        <section class="portfolio-block hire-me">
            <div class="container">
                <div class="heading">
                    <h2>Hire Me</h2>
                </div>
                <form method="post" style = "width: 50% ; margin-left : 20%;margin-top:3%;">
					<div class="form-group">
					  <label  for="taikhoan">Tên :</label>
					  <input type="text" name="id" value="<?=$id?>" hidden="true">

					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="taikhoan" name="taikhoan" 
					  value="<?=$name?>" >

					</div>

					<div class="form-group">
					  <label  for="matkhau">Chức Vụ:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="chucvu" value="<?=$cv?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Điện THoại Cơ Quan:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="coquan" value="<?=$cq?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Email:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="email" value="<?=$em?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Số điện thoại</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="sdt" value="<?=$sdt?>" >
					</div>
					
					<div class="form-group">
					  <label  for="matkhau">Đơn Vị</label>
					  
					  <select style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="donvi" value="<?=$dv?>" >

					  	<option value="<?=$id_dv?>"><?=$dv?></option>
					  	<?php 

					  		$sql = "select * from donvi " ;
					  		$variable = select_list($sql);
					  		foreach ($variable as  $value) { ?>
					  				
					  		<option value="<?=$value['id']?>"><?=$value['name']?></option>

					  	<?php } ?>

					  </select>
					</div>

					<div class="form-group">
					  <label for="anh">Ảnh:</label>
					  
					  <input  placeholder="" type="text" class="form-control" id="thumbnail" name="anh" value="<?=$anh?>" onchange="updateThumbnail()">
					  <img src="<?=$anh?>" style="max-width: 200px;margin-left: 30%" id="img_thumbnail">
					</div>
			
					<button style="width: 50%; margin-left : 20%" class="btn btn-success">Lưu</button>
				</form>
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
</body>

</html>