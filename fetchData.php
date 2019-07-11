<?php
require 'lib/database.php';
if(isset($_GET['search_content'])){
  $content = stripUnicode(sanitize($_GET['search_content']));
  loadData($content);
}
function sanitize($string){
  return htmlspecialchars(strip_tags($string));
}
function loadData($keyword){
  $query = "select tt,ma_so_lop,mshv,sbdc,hoten,phai,ngay_sinh,noi_sinh,ten_nganh from ".$GLOBALS["tbname"]." where key_words like '%" .$keyword. "%';";
  $data = executeQuery($query);
  if(mysqli_num_rows($data)>0){
    $head = true;
    while ($row = mysqli_fetch_assoc($data)) {
      echo "<tr>";
      foreach ($row as $key => $value)
        echo "<td>".$value."</td>";
      echo "</tr>";
    }
  }
}
function stripUnicode($str){
    if(!$str) return "";
    $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
      'A'=>'À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ',
      'd'=>'đ',
      'D'=>'Đ',
      'E'=>'Ê|Ế|Ề|Ệ|Ể|Ễ|É|È|Ẻ|Ẽ|Ẹ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'I'=>'Ì|Í|Ị|Ỉ|Ĩ',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'O'=>'Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'U'=>'Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
      'Y'=>'Ỳ|Ý|Ỵ|Ỷ|Ỹ'
    );
    foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
    return $str;
}
?>

