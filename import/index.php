<?php
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

            else header('Location: ../'); // redirect về trang chủ
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
        if(!insertIntoTable(implode(',', $line)))
            $success = false;
    }
    return $success;
}
?>