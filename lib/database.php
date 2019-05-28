<?php
$server = 'localhost';
$uname = 'root';
$passwd = '';
$dbname = 'student_info';
$tbname = 'danhsach_sv';

$conn = new mysqli($server, $uname, $passwd, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Không thể kết nối tới cơ sở dữ liệu: " . $conn->connect_error);
}

function insertIntoTable($data){
	$flag = false;
	$query = "insert into danhsach_sv values(".$data.");";
	// echo $query;
	// echo $query ."<br>";
	if($GLOBALS["conn"]->query($query))
		$flag = true;
	else {
		echo "Error: " . $query . "<br>" . $GLOBALS["conn"]->error;
		$flag = false;
	}
	// return $flag; // return true nếu thêm thành công
}
function executeQuery($query){
	return $GLOBALS["conn"]->query($query); 
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
	$result = executeQuery('select salt from users where username = "'.$usname.'"');
	if(mysqli_num_rows($result) > 0)
		return mysqli_fetch_array($result)[0];
	return -1;
}
function auth($usname, $hashedpasswd){
	$salt = getSalt($usname);
	if($salt != -1){
		$hashedhashedpassword = hash('sha256',$hashedpasswd.$salt); //băm lại lần nữa có thêm salt
		$result = executeQuery('select * from users where username = "'.$usname.'" and password = "'.$hashedhashedpassword.'";');
		if(mysqli_num_rows($result) > 0) return true;
	}
	return false;
}

// echo auth($_GET['u'],'4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2');
?>