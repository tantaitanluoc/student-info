

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
  <head>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <link href="style.css" rel ="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Awesome Search Box</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <!-- Coded with love by Mutiullah Samim-->
  <body>
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="" placeholder="Search..." spellcheck="false">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>

    </div>
<?php
//  Include thư viện PHPExcel_IOFactory vào
include 'lib/Classes/PHPExcel/IOFactory.php';

$inputFileName = 'data/test.xlsx';

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
echo "<table id='my-table' style='border:1px solid black;'>";
foreach ($rowData as $row) {
  foreach ($row as $value) {
      echo "<tr>";
      foreach ($value as $key) {
          echo "<td>";
          echo $key;
          echo "</td>";
          # code...
      }
      echo "</tr>";
  }
  # code...
}
echo "</table>";
//In dữ liệu của mảng
// echo "<pre>";
// print_r($rowData);
// echo "</pre>";

?>
  </body>
</html>