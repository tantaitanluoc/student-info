<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href ="loginform.css" rel ="stylesheet">
<title>Đăng nhập quyền quản trị</title>
</head>
<body>
	<div id="login-wrapper" class ="jumbotron" >
		<div class='container'>
			<span class="glyphicon glyphicon-list-alt"></span>
				<h2>Quản trị viên</h2>
				<div class ='box'>
			<form id= 'login-form' method="post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
				<input type = "text" name = 'username' required placeholder ="Tên đăng nhập">
				<input type="password" name="password" required placeholder="Mật khẩu">
				<input type="submit" class="button" name="submit" value="Đăng nhập" >
				<a href =# value=""><h6>Đổi mật khấu</h6></a>
			</form>
		</div>
	</div>	
	
	<div id ="info-wrapper" class ="jumbotron" style = display:none>
		<div class ='container'>	
			<form id ="infomation-form" method ="post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
				<h2>Đổi mật khẩu></h2>
				<div class id= 'box'>
					<input type ="text" name = 'username' required placeholder ="Tên đăng nhập">
					<input type	="password" name="password" required placeholder="Mật khẩu hiện tại">
					<input type ="password" name = "password" required placeholder="Mật khẩu mới">
					<input type ="password" name = "password" required placeholder="Xác nhận mật khẩu">
					<input type	="submit" class="button" name="submit" value="Lưu">
					<input type	="submit" class="button" name= "submit" value="Thoát">
				</div>	
 			</form>
		</div>
	</div>
<?php
require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';

if(isset($_POST['submit'])){

}

?>
</body>
</html>