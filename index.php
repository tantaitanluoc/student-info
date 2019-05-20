

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
	require_once("./lib/Classes/PHPExcel.php");
	$file = "test.xlsx";

	$objFile = PHPExcel_IOFactory::identity($file);
	$objData = PHPExcel_IOFactory::createReader($objFile);

	$objData->setReadDataOnly(true);
	$objPHPExcel = $objData->load($file);

	$sheet = $objPHPExcel->setActiveSheetIndex(0); // select sheet 1
	$totalrows = $sheet->getHighestRow();
	$lastColumn = $sheet->getHighestColumn();
	$totalcols = PHPecel_Cell::columnIndexFromString($lastColumn);

	$data = [];

	for($i = 2; $i<=$totalrows; $i++)
		for($j = 0; $j < $totalcols; $j++)
			$data[$i-2][$j] = $sheet->getCellByColumnAndRow($j,$i)->getValue();

	echo "<pre>";
	var_dump($data);
	echo "</pre>";
?>
  </body>
</html>