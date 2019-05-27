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
	<h2>Admin</h2>
	<div class ='box'>
	<form id= 'login-form' method="post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
		<input type = "text" name = 'username' required placeholder ="Tên đăng nhập">
		<input type="password" name="password" required placeholder="Mật khẩu">
		<input type="submit" class="button" name="submit" value="Đăng nhập" >
	</form>
</div>
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