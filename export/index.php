<?php
	if(isset($_GET['data']) or (true!=false)){

		require '../lib/Classes/PHPExcel.php';
		require_once '../lib/Classes/PHPExcel/IOFactory.php';
		$fileType = 'Excel2007';
		$fileName = 'exp_danhsach_'.date("dmY").'.xlsx';
		
		file_put_contents($fileName,"");

		$objPHPExcel = PHPExcel_IOFactory::load($fileName);

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1','MSSV')
			->setCellValue('B1','Họ tên')
			->setCellValue('C1','Giới tính')
			->setCellValue('D1','SĐT')
			->setCellValue('E1','Ngày sinh')
			->setCellValue('F1','Lớp')
			->setCellValue('G1','Địa chỉ');

		// $spreadsheet->getActiveSheet()->getStyle('E1') 
		//     ->getNumberFormat() 
		//     ->setFormatCode( 
		//     PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2
		//     ); 

		$data = $_POST['data'];
		$i = 2;
		foreach ($data as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,$value[0])
				->setCellValue('B'.$i,$value[1])
				->setCellValue('C'.$i,$value[2])
				->setCellValue('D'.$i,$value[3])
				->setCellValue('E'.$i,$value[4])
				->setCellValue('F'.$i,$value[5])
				->setCellValue('G'.$i,$value[6]);
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