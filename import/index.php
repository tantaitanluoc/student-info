<?php
require '../lib/Classes/PHPExcel.php';
require_once '../lib/Classes/PHPExcel/IOFactory.php';
require '../lib/database.php';
    
if(isset($_POST['upload_excel'])){
    $file_info = $_FILES['result_file']['name'];
    $file_directory = "..\uploads\\";
    $new_file_name = "danhsach_".date("dmY").".".end(explode('.',$file_info)); // lấy phần mở rộng file
    $file_path = $file_directory.$new_file_name;
    move_uploaded_file($_FILES['result_file']['tmp_name'],$file_path);
    loadFileToDB($file_path);
    header('Location: ../'); // redirect về trang chủ
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
    for ($i = 2; $i <= $Totalrow; $i++) {
        //----Lặp cột
        for ($j = 1; $j < $TotalCol; $j++) {
            // Tiến hành lấy giá trị của từng ô đổ vào mảng
            $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
        }
    }
    //Insert vào CSDL 
    foreach ($data as $key => $value) {
      insertIntoTable('"'.implode('","', $value).'"');
    }
}

?>