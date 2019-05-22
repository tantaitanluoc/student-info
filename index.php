

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
  <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link href="style.css" rel ="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Awesome Search Box</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <!-- Coded with love by d3t-->
  <body>
    <div class="container h-48">
      <div class="d-flex justify-content-center h-50">
        <div class="searchbar">
          <input id='search_input' class="search_input" type="text" name="" placeholder="Search..." spellcheck="false">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>

    </div>
<?php
header('Content-Type: text/html; charset=utf-8');
//  Include thư viện PHPExcel_IOFactory vào
require 'lib/Classes/PHPExcel.php';
require_once 'lib/Classes/PHPExcel/IOFactory.php';
require 'lib/database.php';
loadData();
function importFromExcel(){
    $file = "data/1.xlsx";

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
    // echo '<pre>';
    // foreach ($data as $key => $value) {
    //   insertIntoTable('"'.implode('","', $value).'"');
    // }
    // echo '</pre>';

}

function loadData(){
  $data = executeQuery("select * from ".$GLOBALS["tbname"]);
  // echo $data;
  if(mysqli_num_rows($data)>0){
    $head = true;
    echo "<table id='my-table' style='border:1px solid black;'>";
    echo "<tr><th>MSSV</th><th>Họ tên</th><th>Giới tính</th><th>SĐT</th><th>Ngày sinh</th><th>Lớp</th><th>Địa chỉ</th>";
    echo "<tbody id=my-table-content>";
    while ($row = mysqli_fetch_assoc($data)) {
      echo "<tr>";
      foreach ($row as $key => $value)
        echo "<td>".$value."</td>";
      echo "</tr>";
    }
    echo "</tbody></table>";
  }
}

function recyclebin(){
    $inputFileName = 'data/1.xlsx';

    //  Tiến hành đọc file excel
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Lỗi không thể đọc file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }

    //  Lấy thông tin cơ bản của file excel

    // Lấy sheet hiện tại
    $sheet = $objPHPExcel->getSheet(0); 

    // Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
    $highestRow = $sheet->getHighestRow(); 

    // Lấy tổng số cột của file, trong trường hợp này là 4 dòng
    $highestColumn = $sheet->getHighestColumn();

    // Khai báo mảng $rowData chứa dữ liệu

    //  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
    for ($row = 1; $row <= $highestRow; $row++){ 
        // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
        $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
    }
    $head = true;
    echo "<table id='my-table' style='border:1px solid black;'>";
    foreach ($rowData as $row) {
      foreach ($row as $value) {
          echo "<tr>";
          foreach ($value as $key) {
            if(!$head){
                echo "<td>";
                echo $key;
                echo "</td>";
                # code...
            }
            else{
                echo "<th>";
                echo $key;
                echo "</th>";
                # code...
            }
          }
           if($head){
              $head = false;
              echo "<tbody id='my-table-content'>";
           }
          echo "</tr>";
      }
      # code...
    }
    echo "</tbody>";
    echo "</table>";
}
echo "<button id='import-table' class='buttons'>Import</button>";
echo "<button id='export-table' class='buttons'>Export</button>";

?>
<!-- <script type="text/javascript">
    var rowData = <?php  ?>;
</script> -->
  </body>

    <script type="text/javascript" src="lib/func.js"></script>

</html>


