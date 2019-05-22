<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	if(isset($_GET['data'])){
		$fin = fopen('filename.txt', 'w+');
		$data = $_GET['data'];
		fwrite($fin, $data);
		fclose($fin);
	}

?>
</body>
</html>