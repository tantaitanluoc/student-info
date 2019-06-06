<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="style.css" rel ="stylesheet">
    <script type="text/javascript">var ___visitor_ = 0</script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>TRA CỨU THÔNG TIN SINH VIÊN</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <!-- Coded with love by d3t-->
  <body>
  <div id="wrapper">
    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>


    <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <div class="container h-48">
      <div class="d-flex justify-content-center h-50">
        <div class="searchbar">
          <input id='search_input' class="search_input" type="text" name="" placeholder="Search..." spellcheck="false">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>

    </div>
<?php
// ini_set('session.cookie_domain',substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'lib/Classes/PHPExcel.php';
require_once 'lib/Classes/PHPExcel/IOFactory.php';
require 'lib/database.php';
loadData();


function loadData(){
  $data = executeQuery("select * from ".$GLOBALS["tbname"]." order by 1");
  // echo $data;
  if(mysqli_num_rows($data)>0){
    $head = true;
    echo "<table id='my-table' style='border:1px solid black;'>";
    echo "<tr><th>STT</th><th>Mã số lớp</th><th>Mã số học viên</th><th>SBDC</th><th id='hotensv'>Họ tên</th><th>Giới tính</th><th>Ngày sinh</th><th>Nơi sinh</th><th>Tên ngành</th>";
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

// function recyclebin(){
//     $inputFileName = 'data/1.xlsx';

//     //  Tiến hành đọc file excel
//     try {
//         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
//         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//         $objPHPExcel = $objReader->load($inputFileName);
//     } catch(Exception $e) {
//         die('Lỗi không thể đọc file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
//     }

//     //  Lấy thông tin cơ bản của file excel

//     // Lấy sheet hiện tại
//     $sheet = $objPHPExcel->getSheet(0); 

//     // Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
//     $highestRow = $sheet->getHighestRow(); 

//     // Lấy tổng số cột của file, trong trường hợp này là 4 dòng
//     $highestColumn = $sheet->getHighestColumn();

//     // Khai báo mảng $rowData chứa dữ liệu

//     //  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
//     for ($row = 1; $row <= $highestRow; $row++){ 
//         // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
//         $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
//     }
//     $head = true;
//     echo "<table id='my-table' style='border:1px solid black;'>";
//     foreach ($rowData as $row) {
//       foreach ($row as $value) {
//           echo "<tr>";
//           foreach ($value as $key) {
//             if(!$head){
//                 echo "<td>";
//                 echo $key;
//                 echo "</td>";
//                 # code...
//             }
//             else{
//                 echo "<th>";
//                 echo $key;
//                 echo "</th>";
//                 # code...
//             }
//           }
//            if($head){
//               $head = false;
//               echo "<tbody id='my-table-content'>";
//            }
//           echo "</tr>";
//       }
//       # code...
//     }
//     echo "</tbody>";
//     echo "</table>";
// }
if(isset($_SESSION['admin_mode'])){
  if($_SESSION['admin_mode']==true){
    echo "<button id='import-table' class='buttons' class='pull-right hidden-print'>Import</button>";
    echo "<button id='export-table' class='buttons' class='pull-right hidden-print'>Export
    </button>";
    echo "<button id='log-out' class='buttons' class='pull-right hidden-print'>Log out</button>";
  }
}

?>

</div>
<div id='upload-excel' style="display: none;">
  <form method="post" action="import/index.php" enctype="multipart/form-data" class="form-horizontal">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <label class="col-sm-3 label-on-left" style="margin-top: -16px;"></label> 
                <div class="col-md-6">
                    <input name="result_file"  required=""  type="file">
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" >
        <div class="col-sm-3" style="width: 31%;margin-top: 15px;"> 
            <div class="pull-right hidden-print">
                <button type="submit" class="btn btn-primary btn-rounded" name="upload_excel" >
                  Upload
                </button>
            </div>
        </div>
    </div>   
  </form>
</div>
<?php echo '<iframe id="rappers"></iframe>';?>
</body>

    <script type="text/javascript" src="lib/func.js"></script>

</html>


