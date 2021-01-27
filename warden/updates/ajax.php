<?php 
	
	//insert new update
	if (isset($_POST['btnAddUpdate'])){ 
        // $sql = "INSERT INTO `eh_updates` (`title`, `content`, `hyperlink`, `created_by`, `created_by_role`) VALUES ('".clean($_POST['title'])."', '".clean($_POST['content'])."','".$_POST['hyperlink']."','".$_POST['created_by']."', '".$_POST['created_by_role']."')";
        // if(mysqli_query(Database::getConnection(),$sql)){
        //     echo alert_style('success','<strong>Success ! </strong> Update is added and published on homepage.');
        //     unset($_POST);


        //     notifyStudents("Please Check latest news and updates secction.","Important");
        // }
        // else{
        //     echo alert_style('danger','<strong>Error Occured: </strong>'.mysqli_error(Database::getConnection()));
        // }

        echo "<pre>";
        print_r($_POST);
    }
?>