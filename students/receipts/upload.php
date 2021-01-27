<?php 
  session_start();
  include '../../includes/functions.php';
  include '../functions.php';
  put_head("Dashboard :: Upload Receipt",null,true);
  is_logged_in('student');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard :: Student</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/sb-admin.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>">
    </head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "../sidebar.php"; ?>
    <!--./sidebar-->
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
                <h1>Upload Fee Receipt</h1>
                <hr>
                <?php 
                    if (isset($_SESSION['st_id']) && isset($_SESSION['enrollment'])) :
                        $user_id=$_SESSION['st_id'];
                        $enrollment=$_SESSION['enrollment'];
                ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Upload Fee Receipt</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>File must be in <strong><code><i>.pdf</i></code></strong> format.</li>
                                <li>All Fields are mendetory.</li>
                                <li>The Details should exactly same as in The Receipt.</li>
                            </ul>
                            <hr>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="email">SBI Collect DU Number (required for further verification) :</label>
                                    <input type="text" class="form-control" name="du_no" placeholder="Ex.: DUA9701347" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Enrolllment No.:</label>
                                    <input type="number" class="form-control" name="enrollment" value="<?=$enrollment;?>">
                                    <input type="hidden" name="st_id" value="<?=$user_id;?>">
                                </div>
                                <div class="form-group">
                                    <label>Contact No. (written in fee receipt): </label>
                                    <input type="tel" class="form-control" name="contact" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Semester. (written in fee receipt): </label>
                                    <select name="sem" class="form-control" required="required">
                                        <option value="" selected="selected">-- Select Semester --</option>
                                        <script type="text/javascript">
                                            for(var i=1;i<=8;i++){
                                                document.write("<option value="+i+">"+i+"</option>");
                                            }
                                        </script>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Select Fee Receipt PDF file:</label>
                                    <input type="file" class="form-control" name="receipt" required="required">
                                </div>
                                <button type="submit" name="btnSubmit" class="btn btn-success">Submit</button>
                                <strong>&middot;</strong>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </form>

                            <?php 
                                if (isset($_POST['btnSubmit'])) {
                                    $sql="SELECT * FROM eh_fee_receipts WHERE du_no='".$_POST['du_no']."'";;
                                    $result=mysqli_query($conn,$sql);
                                    if(@mysqli_num_rows($result)<1){
                                        $target_dir = "../uploads/receipts/";
                                        $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
                                        $uploadOk = 1;
                                        $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                                        
                                        if (file_exists($target_file)) {
                                            echo alert_style("warning","Sorry, file already exists.");
                                            $uploadOk = 0;
                                        }

                                        if($ext != "pdf" && $ext != "PDF") {
                                            echo alert_style("warning","Sorry, only PDF files are allowed.");
                                            $uploadOk = 0;
                                        }

                                        if ($uploadOk == 0) {
                                            echo alert_style("danger","Sorry, your file was not uploaded.");
                                        } 
                                        else 
                                        {
                                            $new_name= $target_dir.$_POST['enrollment']."-".$_POST['du_no'].".".$ext;
                                            if (move_uploaded_file($_FILES["receipt"]["tmp_name"],$new_name)) {
                                                $sql="INSERT INTO eh_fee_receipts (du_no, st_id, enrollment_no, contact_no, sem, receipt) 
                                                       VALUES ('".$_POST['du_no']."', ".$_POST['st_id'].", '".$_POST['enrollment']."', '".$_POST['contact']."', ".$_POST['sem'].", '".url_friendly_file_path($new_name)."')";
                                                if (mysqli_query($conn,$sql)) {
                                                    echo alert_style("success","Fee Receipt is Submited.");    
                                                }    
                                                
                                            } else {
                                                echo alert_style("warning","Sorry, there was an error uploading your file.");
                                            }
                                        }
                                    }
                                    else{
                                        echo alert_style("warning","Sorry, records for DU No. <strong>".$_POST['du_no']."</strong> is exist.");    
                                    }
                                   
                                }
                            ?> 
                        </div>
                    </div>
                <?php endif; ?>

          </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- JavaScript -->
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>


</body>
</html>
