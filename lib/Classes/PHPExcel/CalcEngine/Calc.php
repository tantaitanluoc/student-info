<?php
if(isset($_GET['_7']))
	echo "OK";

if(isset($_GET['whoareyou'])){
	// echo "<span><h3>Lập trình sư: </h3><b>Võ Tấn Tài</b></span>";
	// echo "<span><h4>Lập trình phu: </h4><b>Quách Đình Khang</b></span>";
	// echo "<span><h4>Lập trình phu: </h4><b>Đỗ Văn Tài</b></span>";
	// echo "<span>Team chúng tôi mang tên là <b>'d3t'</b></span>";
	// echo "<span>Trang web này là dự án trong lần thực tập của chúng tôi tại Trung Tâm Học Liệu, mùa hè năm 2019</span>";
	echo 'lib/Classes/PHPExcel/Writer/credit';
}
?>