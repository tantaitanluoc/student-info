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
	}

	echo $username."<br>".$hashedpasswd."<br>".passingSalt();
}

?>
</body>
</html>