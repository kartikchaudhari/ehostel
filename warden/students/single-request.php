<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('warden');
  put_head("Dashboard :: Warden",null,true);
?>

<div id="wrapper">
    
    <!-- Sidebar -->
    <?php include __DIR__."../../sidebar.php"; ?>
    <!--./sidebar-->

    <!-- page content-->
    <div id="page-wrapper">

        <!--breadcrumbs-->
        <?php 
            $root=array('url'=>base_url('admin/dashboard.php'),'text'=>'Dashboard');
            $child=array(
                            array('url'=>'#','text'=>'Students'),
                            array('url'=>base_url('warden/students/registration_requests.php'),'text'=>'Registration Requests'),
                            array('url'=>'#','text'=>'Single Registration Request')
                        );
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <?php 
            if(is_numeric($_GET['st_id'])){
                $st_id=$_GET['st_id'];
                $sql="SELECT * FROM eh_students AS t1 RIGHT JOIN eh_registration_docs AS t2 ON t1.st_id=t2.st_id  WHERE t1.st_id=$st_id";
                $query=mysqli_query(Database::getConnection(),$sql);
                if($query->num_rows>0){
                    $result=mysqli_fetch_assoc($query);
            ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Registration Request ID: #<?=$result['st_id']?> <?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname']) ?> <?=request_status($result['account_status']);?></h3>
            </div>
            <div class="panel-body">
              
                <div class="alert alert-info">
                    <table align="center" width="100%" border="0">
                        <tr>
                            <td align="left" ><strong>Date of Registration: </strong> : <?=$result['date_creation'];?></td>
                            <td align="right"><strong>Date of Registration: </strong> : <?=$result['date_creation'];?></td>
                        </tr>
                    </table>
                </div>
                <div class="wrapper center-block">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- personal details -->
                        <div class="panel panel-info">
                            <div class="panel-heading active" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>Personal Details</strong>
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table class="table" width="100%" border="0" style="margin-bottom: 0px;">
                                        <tr>
                                            <td width="200" align="right"><strong>Name: </strong></td>
                                            <td><span id="stu_fullname"><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname']) ?></span></td>
                                            <td rowspan="5" colspan="2" valign="middle" align="center" style="vertical-align: middle;">
                                                <img style="width: 80px;" src="<?=base_url($result['avatar']);?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Cast: </strong></td>
                                            <td><?=pull_cast_by_id($result['cast_id']);?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Gender: </strong></td>
                                            <td>
                                                <?php
                                                    if($result['gender']=="M"){
                                                        echo "Male";
                                                    }

                                                    if($result['gender']=="F"){
                                                        echo "Female";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Student Contact No.: </strong></td>
                                            <td><span id="stu_contact"><?=$result['contact']?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Student Email Address: </strong></td>
                                            <td><span id="stu_email"><?=$result['email']?></span></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Parents Contact No.: </strong></td>
                                            <td><?=$result['p_contact'];?></td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Address: </strong></td>
                                            <td width="40%;"><?=$result['pr_address'];?></td>

                                            <td align="right"><strong>City: </strong></td>
                                            <td><?=$result['pr_city'];?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>District: </strong></td>
                                            <td width="40%;"><?=$result['pr_district'];?></td>

                                            <td align="right"><strong>State: </strong></td>
                                            <td><?=$result['pr_state'];?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Country: </strong></td>
                                            <td width="40%;"><?=$result['pr_country'];?></td>

                                            <td align="right"><strong>Pincode: </strong></td>
                                            <td><?=$result['pr_pincode'];?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right"><strong>Approximate distance in KM for your residence address to VGEC:</strong></td>
                                            <td colspan="2"><?=$result['distance']?> KM</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--./personal details-->

                        <!-- Academic Details -->
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      <strong>Academic Details</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <table class="table table-hover" width="60%" border="0" style="margin-bottom: 0px;">
                                        <tr>
                                            <td align="right"><strong>ACPC Merit No.: </strong></td>
                                            <td><span id="stu_meritno"><?=$result['enrollment'];?></span></td>

                                            <td align="right"><strong>Admission Branch.: </strong></td>
                                            <td><?=pull_dept_by_id($result['dept_id']);?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--./Academic Details-->

                        <!-- bank details -->
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      <strong>Bank Details</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <table class="table table-hover" width="70%" border="0" style="margin-bottom: 0px;">
                                        <tr>
                                            <td align="right"><strong>Bank Account No.: </strong></td>
                                            <td><?=$result['bank_ac_no'];?></td>

                                            <td align="right"><strong>Account Holder's Name: </strong></td>
                                            <td><?=strtoupper($result['bank_ac_name']);?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><strong>Bank Name: </strong></td>
                                            <td><?=$result['bank_name'];?></td>

                                            <td align="right"><strong>Bank IFSC Code No.: </strong></td>
                                            <td><?=strtoupper($result['bank_ifsc']);?></td>
                                        </tr>
                                    </table> 
                                </div>
                            </div>
                        </div>
                        <!--./bank details-->

                        <!-- attachments -->
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                      <strong>Submitted Documents</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?php 
                                            if($result['admission_letter_path']!=null){
                                        ?>
                                            <a href="#" class="list-group-item" title="Click here to Open Admission Letter in new Window" onclick="openWindow('<?=base_url("warden/students/viewer.php?st_id=".$result['st_id']."&record_id=".$result['record_id']."&doc_type=1")?>')">Admission Letter</a>
                                        <?php
                                            }
                                        ?>
                                        <?php 
                                            if($result['residence_proof_path']!=null){
                                        ?>
                                            <a href="#" class="list-group-item" title="Click here to Open Residence proof in new Window" onclick="openWindow('<?=base_url("warden/students/viewer.php?st_id=".$result['st_id']."&record_id=".$result['record_id']."&doc_type=2")?>')">Residence Proof</a>
                                        <?php
                                            }
                                        ?>
                                        <?php 
                                            if($result['payment_receipt_path']!=null){
                                        ?>
                                            <a href="#" class="list-group-item" title="Click here to Open Fee Receipt in new Window" onclick="openWindow('<?=base_url("warden/students/viewer.php?st_id=".$result['st_id']."&record_id=".$result['record_id']."&doc_type=4")?>')">SBI Collect Fee Receipt</a>
                                        <?php
                                            }
                                        ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <!--./attachments-->

                        <!-- allot-room -->
                        <div class="panel panel-success">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title active">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <strong>Allot room and Confirm Hostel Registration</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <div id="hostel_selectors" class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <select id="hostel_id" class="form-control" required="required">
                                                    <option value="0">--- Select Hostel ---</option>
                                                    <?php
                                                        $sql="SELECT info_id, hostel_name FROM eh_hostel_info WHERE hostel_status=1";
                                                        $query=mysqli_query(Database::getConnection(),$sql);
                                                        while($result=mysqli_fetch_assoc($query)){
                                                            echo "<option value='".$result['info_id']."'>".$result['hostel_name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select id="block_id" class="form-control" required="required">
                                                    <option value="0">--- Select Hostel Block ---</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select id="room_no" class="form-control" required="required">
                                                    <option value="">--- Select Room No. ---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" id="request_operation_buttons">
                                        <div class="col-md-12">
                                            <!-- accept request button -->
                                            <div class="col-md-6">
                                                 <strong class="text-center text-justify">By Pressing "Accept Request and Allot Room" button, Registration request of student will acepted, eHostel account will activated and the Room will be alloted to that student.</strong><br><br>
                                                 <button id="acceptRequest" type="button" title="Accept Request and Allot Room" class="btn btn-success btn-block">Accept Request and Allot Room</button>
                                            </div>
                                            <!--./accept request button-->

                                            <!-- reject request button -->
                                            <div class="col-md-6">
                                                <br><br><br><br>
                                                <button type="button" title="Reject Request" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal">Reject Request</button>
                                            </div>
                                            <!--./reject request-->
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <div class="col-md-12">
                                           <!-- message -->
                                            <div id="message">
                                            </div>
                                            <!-- message-->
                                       </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./allot room-->
                    </div>
                </div>
                
                
                <!-- reject request modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Reject Request</h4>
                            </div>
                            <div class="modal-body">
                                <select id="rejection_reason_opt" class="form-control" required="required">
                                    <option value="0">--- Select Application Rejection Reason ---</option>
                                    <option value="Wrong Information">Wrong Information</option>
                                    <option value="Information does not fit in selection criteria">Information does not fit in selection criteria</option>
                                    <option value="Rooms are full">Rooms are full</option>
                                    <option value="1">Other Reason (Needs to write in textbox)</option>
                                </select>
                                <br>
                                <textarea id="rejection_reason_text" class="form-control" rows="3" required="required" placeholder="Enter Reason for Request Rejection." style="display: none;"></textarea>
                            </div>
                            <div class="modal-footer">
                                <img id="ajax-loader" src="<?=base_url('assets/images/ajax-loader.gif')?>" style="display: none;">
                                <button id="btnSubmitRejectRequest" type="button" class="btn btn-primary" disabled="disabled" onclick="doCancelRequest();">Submit</button> 
                                <strong>&middot;</strong>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./-->
            </div>
            <!--./content-->
        </div>
            <?php 
                }

                else{
            ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Not Found</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Not Found</strong> <span>Data not Found with Reqiest ID <strong>#<?=$_GET['st_id'];?></strong></span>
                    </div>
                </div>
            </div>
        <?php
                }

            }
            else{
            
        ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">No Data Found</h3>
                </div>
                <div class="panel-body">
                    <h4 align="center">Data No found</h4>
                </div>
            </div>
        <?php 
         }
        ?>
        <!--./content-->
    </div>
    <!--./page content-->
</div>
<!-- footer -->

<?php
    $js='<script type="text/javascript">';
    $js.="$(document).ready(function(){
            $('#hostel_id').change(function(){
                var id=$(this).val();
                $.ajax({
                    type: 'POST',
                    url: '".base_url('warden/students/ajax.php')."',
                    data: {hostel_id:id,block_fetch_action:''},
                    cache: false,
                    success: function(data){
                        $('#block_id').html(data);
                        $('#block_id').focus();
                    } 
                });
            });

            $('#block_id').change(function(){
                var fetched_block_id=$(this).val();
                var fetched_hostel_id=$('#hostel_id').val();
                $.ajax({
                    type: 'POST',
                    url: '".base_url('warden/students/ajax.php')."',
                    data: {hostel_id:fetched_hostel_id,block_id:fetched_block_id,room_fetch_action:''},
                    cache: false,
                    success: function(data){
                        $('#room_no').html(data);
                        $('#room_no').focus();
                    } 
                });
            });

            $('#rejection_reason_opt').change(function(){
                var reason_id=$(this).val();
                var reason_text;
                $('#btnSubmitRejectRequest').removeAttr('disabled');
                if(reason_id==0){
                    $('#btnSubmitRejectRequest').attr('disabled','disabled');
                }
                else{
                    if(reason_id==1){
                        $('#rejection_reason_text').css('display','block');
                    }
                    else{
                        $('#rejection_reason_text').css('display','none');
                    }

                    $('#btnSubmitRejectRequest').removeAttr('disabled');
                }
                
            });

    });

    function doCancelRequest(){
        $('#ajax-loader').css('display','block');
        $('#btnSubmitRejectRequest').html('Loading...');
        $('#btnSubmitRejectRequest').attr('disabled','disabled');

        var st_id=".$_GET['st_id'].";
        var stu_merit_no=$('#stu_meritno').html();
        var stu_fullname=$('#stu_fullname').html();
        var stu_contact=$('#stu_contact').html();
        var stu_email=$('#stu_email').html();
        var reason;
        if($('#rejection_reason_opt').val()!=0){
            if($('#rejection_reason_opt').val()!=1){
                reason=$('#rejection_reason_opt').val();
            }
            else{
                reason=$('#rejection_reason_text').val();
            }

            $.ajax({
                type: 'POST',
                url: '".base_url('warden/students/ajax.php')."',
                data: {st_id:st_id,fullname:stu_fullname,stu_merit_no:stu_merit_no,stu_contact:stu_contact,stu_email:stu_email,reason:reason,reject_request_action:''},
                cache: false,
                success: function(data){
                    if(data==1){
                        $('#ajax-loader').css('display','none');
                        $('#btnSubmitRejectRequest').html('Submit');
                        $('#btnSubmitRejectRequest').removeAttr('disabled');
                        $('#myModal').modal('hide');

                        $('#request_operation_buttons').css('display','none');
                        $('#hostel_selectors').css('display','none');

                        $('#message').html('<div class=\"alert alert-success\"><strong>Success!</strong> Request ID: ".$_GET['st_id']."  was sucessfully rejected.</div>');
                    }
                } 
            });
        }
    }
    ";
    $js.='</script>';
    put_footer(false,$js); 
?>
