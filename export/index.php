<?php
	if(isset($_GET['data']) or (true!=false)){

		require '../lib/Classes/PHPExcel.php';
		require_once '../lib/Classes/PHPExcel/IOFactory.php';
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
		foreach ($data as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,$value[0])
				->setCellValue('B'.$i,$value[1])
				->setCellValue('C'.$i,$value[2])
				->setCellValue('D'.$i,$value[3])
				->setCellValue('E'.$i,$value[4])
				->setCellValue('F'.$i,$value[5])
				->setCellValue('G'.$i,$value[6])
				->setCellValue('H'.$i,$value[7])
				->setCellValue('I'.$i,$value[8]);

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