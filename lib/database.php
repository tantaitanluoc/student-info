<?php



// Code by Vo Tan Tai
// Contact me: tantaivo2015@gmail.com 




$server = 'localhost';
$uname = 'root';
$passwd = '';
$dbname = 'student_info';
$tbname = 'danhsach_sv';

$conn = new mysqli($server, $uname, $passwd, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Lỗi Server. Không thể kết nối tới cơ sở dữ liệu! ");
}

function insertIntoTable($data){
	$flag = false;
	$query = "insert into ".$GLOBALS["tbname"]." values(".$data.");";
	if($GLOBALS["conn"]->query($query))
		$flag = true;
	else {
		$flag = false;
	}
	return $flag; // return true nếu thêm thành công
}
function executeQuery($query){
	try{
		$result = $GLOBALS["conn"]->query($query); 
		return $result;
	}catch(Exception $e){
		return false;
	}
}
function passingSalt($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getSalt($usname){
	$result = executeQuery('select salt from users where username = "'.$usname.'";');
	if(mysqli_num_rows($result) > 0)
		return mysqli_fetch_array($result)[0];
	return -1;
}
function auth($usname, $hashedpasswd){
	$salt = getSalt($usname);
	if($salt != -1){
		$hashedhashedpassword = hash('sha256',$hashedpasswd.$salt); //băm bát mới chấm muối
		$result = executeQuery('select * from users where username = "'.$usname.'" and password = "'.$hashedhashedpassword.'";');
		if(mysqli_num_rows($result) > 0) return true;
	}
	return false;
}
function changePasswd($username, $hashednewpasswd){
	$salt = passingSalt(); // tạo một salt mới
	$hashedhashednewpasswordohmygod = hash('sha256', $hashednewpasswd.$salt);
	// cập nhật cả mật khẩu mới lẫn salt mới
	$query = 'update users set password = "'.$hashedhashednewpasswordohmygod.'", salt = "'.$salt.'" where username = "'.$username.'";';
	if($GLOBALS["conn"]->query($query)) return true;
	return false;
}
echo getSalt('admin').'<br>';
echo auth('admin', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2')? 'true':'false';
?>