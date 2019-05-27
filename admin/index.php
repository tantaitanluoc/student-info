<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập quyền quản trị</title>
</head>
<body>
<div id="login-wrapper">
	<form id= 'login-form' method="post" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
		<label for="username">Tên đăng nhập</label>
		<input type = "text" name = 'username' required><br>
		<label for="password">Mật khẩu</label>
		<input type="password" name="password" required><br>
		<input type="submit" name="submit" value="Đăng nhập">
	</form>
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