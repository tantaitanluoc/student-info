<?php


  // Code by Vo Tan Tai
  // Contact me: tantaivo2015@gmail.com 

require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';
session_start();
    
if(isset($_POST['upload_excel'])){
    if(isset($_SESSION['admin_mode'])){
        if($_SESSION['admin_mode']===true){
            $file_info = $_FILES['result_file']['name'];
            $file_directory = "..\uploads\\";
            $new_file_name = "danhsach_".date("dmY").".".end(explode('.',$file_info)); // lấy phần mở rộng file
            $file_path = $file_directory.$new_file_name;
            move_uploaded_file($_FILES['result_file']['tmp_name'],$file_path);
            if(!loadFileToDB($file_path))
                echo "<script>alert('Lỗi khi nhập'); window.location = '../'</script>";

            else {
                alert('Nhập vào cơ sở dữ liệu thành công');
                header('Location: ../'); // redirect về trang chủ
            }
            unlink($file_path);
        }
    }
    else echo "<script>alert('Bạn không có quyền import, vui lòng đăng nhập quản trị'); window.location = '../'</script>";
}

function loadFileToDB($file){
    $objFile = PHPExcel_IOFactory::identify($file);
    $objData = PHPExcel_IOFactory::createReader($objFile);

    //Chỉ đọc dữ liệu
    $objData->setReadDataOnly(true);

    // Load dữ liệu sang dạng đối tượng
    $objPHPExcel = $objData->load($file);

    //Lấy ra số trang sử dụng phương thức getSheetCount();
    // Lấy Ra tên trang sử dụng getSheetNames();

    //Chọn trang cần truy xuất
    $sheet = $objPHPExcel->setActiveSheetIndex(0);

    //Lấy ra số dòng cuối cùng
    $Totalrow = $sheet->getHighestRow();
    //Lấy ra tên cột cuối cùng
    $LastColumn = $sheet->getHighestColumn();

    //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
    $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

    //Tạo mảng chứa dữ liệu
    $data = [];
    //Tiến hành lặp qua từng ô dữ liệu
    //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
    $colLength = min($TotalCol,9);
    for ($i = 2; $i <= $Totalrow; $i++) {
        //----Lặp cột
        for ($j = 0; $j < $colLength; $j++) {
            // $cell = $sheet->getCellByColumnAndRow($j, $i)->getValue();
            // Tiến hành lấy giá trị của từng ô đổ vào mảng
            $temp = $sheet->getCellByColumnAndRow($j, $i)->getValue();
            $data[$i - 2][$j] = $temp;
        }
    }
    //Insert vào CSDL 
    $success = true;
    foreach ($data as $key => $value){
        $line = array();
        foreach ($value as $valuelue){
            if(is_string($valuelue))
                array_push($line,'"'.$valuelue.'"'); // Nếu là kiểu chuỗi thì bao trong dấu ngoặc kép
            else array_push($line, $valuelue);
        }
        array_push($line,stripUnicode('"'.trim($line[2],'"').";".trim($line[4],'"').";".trim($line[8],'"').'"')); // bỏ dấu và gộp các trường mshv, hoten, ten_nganh để insert vào key_words
        // do các trường kia đã thêm dấu ngoặc kép từ trước nên cần cắt bỏ (trim) đi 

        if(!insertIntoTable(implode(',', $line)))
            $success = false;
    }
    return $success;
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