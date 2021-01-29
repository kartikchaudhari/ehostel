<?php 
	require __DIR__.'../../../includes/functions.php';
    if (isset($_POST['delete_action']) && isset($_POST['update_id'])) {
        $update_id=$_POST['update_id'];
        $sql="DELETE FROM eh_updates WHERE update_id=$update_id";
        if (mysqli_query(Database::getConnection(),$sql)) {
            echo 'Deleted successfully.';
        }
    }
?>