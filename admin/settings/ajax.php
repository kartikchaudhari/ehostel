<?php 
	require '../../includes/functions.php';

    //update admision start and end dates 
    if(isset($_POST['action'])){
        $action=clean($_POST['action']);
        
        if ($action=="admission_dates") {
            $adm_start_date=$_POST['adm_start_date'];
            $adm_end_date=$_POST['adm_end_date'];

            $sql="UPDATE eh_settings SET registration_start = '".$adm_start_date."', registration_end = '".$adm_end_date."'";
            if(mysqli_query(Database::getConnection(),$sql)){
                echo true;
            }
            else{
                echo mysqli_error(Database::getConnection());
            }    
        }
    }

    /*update admission rules and instrucions*/
    if (isset($_POST['admrules_inst'])) {
        $admrules_inst= html_encoder($_POST['admrules_inst']);
        $sql="UPDATE eh_settings SET admission_rule_instruction='".$admrules_inst."'";
        if(mysqli_query(Database::getConnection(),$sql)){
            //notifyStudents("Hostel Rules are Updated please Review them.","Important");
            echo true;
        }
        else{
            echo mysqli_error(Database::getConnection());
        }       
    }

	/*update hostel rules*/
	if (isset($_POST['hrules'])) {
	    $hrules= html_encoder($_POST['hrules']);
        $sql="UPDATE eh_settings SET hostel_rules_content='".$hrules."'";
        if(mysqli_query(Database::getConnection(),$sql)){
            //notifyStudents("Hostel Rules are Updated please Review them.","Important");
            echo true;
        }
        else{
        	echo mysqli_error(Database::getConnection());
        }    	
	}



?>