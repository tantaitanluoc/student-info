<!DOCTYPE html>
<html>
<head>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href ="loginform.css" rel ="stylesheet">
<title>Đăng nhập quyền quản trị</title>
<script type="text/javascript">
	 $(document).ready(function(){
	 	$('#change-passwd').on("click", function(){
		  	$('#info-wrapper').show();
		  	$('#login-wrapper').hide();
	  	});
	  	$('#cancel').on("click",function(){
		  	$('#login-wrapper').show();
	  		$('#info-wrapper').hide();
	  	})
	 })
</script>
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
				<a href =# id="change-passwd"><h6>Đổi mật khấu</h6></a>
			</form>
		</div>
	</div>	
</div>
	
	<div id ="info-wrapper" class ="jumbotron" style = display:none>
		<div class ='container'>	
			<form id ="infomation-form" method ="post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
				<h2>Đổi mật khẩu</h2>
				<div class id= 'box'>
					<input type ="text" name = 'username' required placeholder ="Tên đăng nhập">
					<input type	="password" name="password" required placeholder="Mật khẩu hiện tại">
					<input type ="password" name = "password" required placeholder="Mật khẩu mới">
					<input type ="password" name = "password" required placeholder="Xác nhận mật khẩu">
					<input type	="submit" class="button" name="submit" value="Lưu">
					<a href=# id ='cancel' value=""> Thoát </a>
				</div>	
 			</form>
		</div>
	</div>
<?php
require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';

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