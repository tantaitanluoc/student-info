<?php

if(isset($_POST['data'])){

	require '../lib/Classes/PHPExcel.php';
	require_once '../lib/Classes/PHPExcel/IOFactory.php';
	require '../lib/database.php';
	$fileType = 'Excel2007';
	$fileName = 'exp_danhsach_'.date("dmY").'.xlsx';
	
	file_put_contents($fileName,"");

	$objPHPExcel = PHPExcel_IOFactory::load($fileName);

	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','STT')
		->setCellValue('B1','Mã số lớp')
		->setCellValue('C1','Mã số học viên')
		->setCellValue('D1','SBDC')
		->setCellValue('E1','Họ tên')
		->setCellValue('F1','Giới tính')
		->setCellValue('G1','Ngày sinh')
		->setCellValue('H1','Nơi sinh')
		->setCellValue('I1','Tên ngành');

	$data = $_POST['data'];
	$i = 2;
	$query = 'select distinct * from '.$GLOBALS['tbname'].' where mshv in ("'.implode('","', $data).'") order by 1;';
	$rs = executeQuery($query);
	while ($row = mysqli_fetch_assoc($rs)) {
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i,$row['tt'])
			->setCellValue('B'.$i,$row['ma_so_lop'])
			->setCellValue('C'.$i,$row['mshv'])
			->setCellValue('D'.$i,$row['sbdc'])
			->setCellValue('E'.$i,$row['hoten'])
			->setCellValue('F'.$i,$row['phai'])
			->setCellValue('G'.$i,$row['ngay_sinh'])
			->setCellValue('H'.$i,$row['noi_sinh'])
			->setCellValue('I'.$i,$row['ten_nganh']);

		$i++;
	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,$fileType);

	try{
		$objWriter->save($fileName);
	}catch(Exception $e){
		die('Error: '.$e);
	}
	echo $fileName;
}

?>