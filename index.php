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
  <body>
  
  <div id="wrapper">
  <img id="logo_big" src= "logo.png" />
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <div class="container h-48">
   
      <div class="d-flex justify-content-center h-50">
        <div class="searchbar">
          <input id='search_input' class="search_input" type="text" name="" placeholder="Nhập họ tên, Mã số hoặc Tên ngành..." spellcheck="false">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>

    </div>
<?php


// Code by Vo Tan Tai
// Contact me: tantaivo2015@gmail.com 



session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh"); // GMT+7
$log_file = 'logs/'.date("d-m-Y").'.log';
if(!file_exists($log_file))
	file_put_contents($log_file, "");
$fin = fopen($log_file,'a+');

// ghi nhận IP người truy cập
fwrite($fin, getUserIpAddr()."\t\t".date('h:i:sa').PHP_EOL);


header('Content-Type: text/html; charset=utf-8');
require 'lib/Classes/PHPExcel.php';
require_once 'lib/Classes/PHPExcel/IOFactory.php';
require 'lib/database.php';
// loadData();

function showSearchForm(){
  //code
}


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

if(isset($_SESSION['admin_mode'])){
  if($_SESSION['admin_mode']===true){
    echo "<button id='import-table' class='buttons' class='pull-right hidden-print'>Import</button>";
    echo "<button id='export-table' class='buttons' class='pull-right hidden-print'>Export
    </button>";
    echo "<button id='log-out' class='buttons' class='pull-right hidden-print'>Log out</button>";
    echo "<div id='upload-excel' style='display: none;'>
  <form method='post' action='import/index.php' enctype='multipart/form-data' class='form-horizontal'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='row'>
                <label class='col-sm-3 label-on-left' style='margin-top: -16px;'></label> 
                <div class='col-md-6'>
                    <input name='result_file'  required=''  type='file'>
                </div>
            </div>
        </div>
    </div>
    
    <div class='row' >
        <div class='col-sm-3' style='width: 31%;margin-top: 15px;'> 
            <div class='pull-right hidden-print'>
                <button type='submit' class='btn btn-primary btn-rounded' name='upload_excel' >
                  Upload
                </button>
            </div>
        </div>
    </div>   
  </form>
</div>";
  }
}
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>
</div>
<?php echo '<iframe id="rappers"></iframe>';?>
</body>

    <script type="text/javascript" src="lib/func.js"></script>

</html>


