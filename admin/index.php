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
ini_set('session.cookie_domain',substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}


if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = htmlspecialchars(strip_tags(preg_replace('/\s+/', '',$username))); // tránh xss và sql injection
	$hashedpasswd = hash('sha256',$password); // băm với giải thuật SHA256

	if(auth($username,$hashedpasswd)){

		session_start();
		$_SESSION['admin_mode'] = true;
		// header('localhost/student-info/index.php'); // redirect lại trang chủ
		echo "<script>window.location = '../'</script>";
	}
	else echo "<script> alert('Sai tên đăng nhập hoặc mật khẩu!');</script>";

	// echo $username."<br>".$hashedpasswd."<br>".passingSalt();
}

?>
</body>
</html>