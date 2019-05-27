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
?>