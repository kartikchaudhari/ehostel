<?php 
  	require '../../includes/functions.php';
	require_once __DIR__."../../../libs/phpspreadsheet/vendor/autoload.php";
	if($_FILES["import_excel"]["name"] != ''){
 		$allowed_extension = array('xls','xlsx');
 		$file_array = explode(".", $_FILES["import_excel"]["name"]);
 		$file_extension = end($file_array);

 		if(in_array($file_extension, $allowed_extension)){
			$file_name = time() . '.' . $file_extension;
			move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
			$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

			$spreadsheet = $reader->load($file_name);

  			unlink($file_name);

  			$data = $spreadsheet->getActiveSheet()->toArray();
  			
  			for($i=1;$i<count($data);$i++){
  				$query="INSERT INTO eh_rooms (room_no,total_seat,occupied_seat,block_id,hostel_info_id) 
  						VALUES ('".$data[$i][0]."',".$data[$i][1].",".$data[$i][2].",".$data[$i][3].",".$data[$i][4].")";
  				mysqli_query(Database::getConnection(),$query);
		  	}
  			$message = '<div class="alert alert-success">Data Imported Successfully</div>';
 		}
		else{
  			$message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
 		}
	}
	else{
 		$message = '<div class="alert alert-danger">Please Select File</div>';
	}

	echo $message;

?>