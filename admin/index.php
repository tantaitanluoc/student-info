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
	  	});
  		$('#infomation-form').submit(function(e){
  			if($('#newpass').val()!=$('#reenter').val()){
  				$('#error2').html('Nhập lại mật khẩu không khớp').show().fadeOut(4000);
  				e.preventDefault();
  			}
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
				<pre id="error1" style="display: none"></pre>

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
					<input id='newpass' type ="password" name = "new-password" required placeholder="Mật khẩu mới">
					<input id='reenter' type ="password" name = "reenter-new-password" required placeholder="Xác nhận mật khẩu">
					<input id='changepassbtn' type	="submit" class="button" value="Lưu" name='change-passwd'>
					<a href=# id ='cancel' value=""> Thoát </a>
					<pre id="error2" style="display: none"></pre>
				</div>	
 			</form>
		</div>
	</div>
<?php
require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';
function sanitize($string){
	return htmlspecialchars(strip_tags(preg_replace('/\s+/', '',$string)));
}
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = sanitize($username); // tránh xss và sql injection
	$hashed_passwd = hash('sha256',$password); // băm với giải thuật SHA256

	if(auth($username,$hashed_passwd)){
		session_start();
		$_SESSION['admin_mode'] = true;
		echo "<script>window.location = '../'</script>";// redirect lại trang chủ
	}
	else echo "<script>$('#error1').html('Thông tin đăng nhập không chính xác').show().fadeOut(4000);</script>";

	// echo $username."<br>".$hashed_passwd."<br>".passingSalt();
}
if(isset($_POST['change-passwd'])){
	$username = sanitize($_POST['username']);
	$password = sanitize($_POST['password']);
	$new_password = sanitize($_POST['new-password']);
	$reenter_new_password = sanitize($_POST['reenter-new-password']);

	$hashed_passwd = hash('sha256',$password);
	if(auth($username,$hashed_passwd)){
		$hashed_new_passwd = hash('sha256',$new_password);
		if(changePasswd($username,$hashed_new_passwd)){
			echo "<script>alert('Đổi mật khẩu thành công');</script>";
			echo "<script>
					$('#login-wrapper').show();
		  			$('#info-wrapper').hide();
		  			$('input[name=username]').val(".$username.")
		  		</script";
	  	}
	  	else 
			echo "<script>$('#error1').html('Đã xảy ra lỗi, vui lòng kiểm tra lại').show().fadeOut(4000);</script>";
	}
	else
		echo "<script>$('#error1').html('Thông tin đăng nhập không chính xác').show().fadeOut(4000);</script>";
}

?>
</body>
</html>