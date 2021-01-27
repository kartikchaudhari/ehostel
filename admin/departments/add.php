<?php 
	require "../../includes/functions.php";
	is_logged_in('admin');
	put_head("Dashboard :: Add Department");
?>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "../sidebar.php"; ?>
    <!--./sidebar-->
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>My profile</h1> <a class="btn btn-sm btn-primary" href="complete-profile.php?st_id=<?=$_SESSION['st_id'];?>">Update Profile</a>
                <hr>
                <?php 
                    $st_id=$_SESSION['st_id'];
                    $enrollment=$_SESSION['enrollment'];
                    $sql="SELECT * FROM eh_students WHERE st_id=$st_id AND enrollment='$enrollment'";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);
                ?>
                <!-- room info, academic info, student image -->
                <div class="row">
                    <!-- room info -->
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Room Info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input class="form-control" name="hosel_block" value="<?=$row['block_id'];?>" readonly="readonly" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="room" class="form-control" readonly="readonly" placeholder="Room Number" value="<?=$row['room_no'];?>" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="date" name="admission_date" placeholder="Admission Date" value="<?=$row['admission_date'];?>" disabled="disabled">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./room info -->

                    <!--academic info -->
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Academic Info</h3>
                            </div>
                            <div class="panel-body" style="padding-bottom: 30px;">
                                <div class="form-group">
                                    <?php has_dept_set($row['dept_id']); ?>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="enrollment" class="form-control" placeholder="Enter Enrollment/Admission No." required="required" value="<?=$row['enrollment'];?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" name="course_type" required="required">
                                            <option value="">- Course Type -</option>
                                            <?=pull_course($row['c_id']);?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" name="sem_id" required="required">
                                            <option value="" selected="selected">- Semester -</option>
                                            <?=pull_semester($row['sem']);?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./academic info-->
                    
                    <!-- student image -->
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Student Image</h3>
                            </div>
                            <div class="panel-body" style="padding-bottom: 0px;">
                                <div class="form-group">
                                    <img src="<?=base_url('assets/images/default.jpg');?>" class="img-responsive" style="height: 100px;width: 80px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./student image -->
                </div>
                <!--./room info, academic info, student image-->
    
                <!-- personal and address info -->
                <div class="row">
                    <!-- personal info -->
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Personal Info</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="fname" placeholder="First Name" value="<?=$row['fname'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="mname" placeholder="Middle Name" value="<?=$row['mname'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="lname" placeholder="Last Name" value="<?=$row['lname'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="contact" placeholder="Contact Number" value="<?=$row['contact']?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email Address" value="<?=$row['email']?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="e_contact" placeholder="Emergency Contact Number" value="<?=$row['e_contact'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="gr_name" placeholder="Guardian Name" value="<?=$row['gr_name'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="gr_relation" placeholder="Guardian Relation with you" value="<?=$row['gr_relation'];?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="gr_contact" placeholder="Guardian Contact Number" value="<?=$row['gr_contact'];?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./personal info-->

                    <!--address info -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Correspondence Address</h3>
                                </div>
                                <div class="panel-body" style="padding-bottom: 0px;">
                                    <div class="form-group">
                                        <textarea class="form-control" name="c_address" required="required" placeholder="Correspondence Address" rows="1"><?=$row['cr_address'];?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_city" placeholder="City" required="required" value="<?=$row['cr_city'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_state" placeholder="State" required="required" value="<?=$row['cr_state'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="c_country" placeholder="Country" required="required" value="<?=$row['cr_country'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="c_pincode" placeholder="Pincode" required="required" value="<?=$row['cr_pincode'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Parmenant Address</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea class="form-control" name="p_address" required="required" placeholder="Correspondence Address" rows="1"><?=$row['pr_address']?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_city" placeholder="City" value="<?=$row['pr_city'];?>" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_state" placeholder="State" required="required" value="<?=$row['pr_state'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="p_country" placeholder="Country" required="required" value="<?=$row['pr_country'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="p_pincode" placeholder="Pincode" required="required" value="<?=$_POST['pr_pincode'];?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="st_id" value="<?=$st_id;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--./address info-->
                </div>
                <!--./personal and address info-->

                <!-- buttons-->
                <div class="row">
                    <div class="col-md-4 col-md-offset-5">
                        <button name="btnUpdate" type="submit" class="btn btn-success">Print</button>
                    </div>
                </div>
                <!--./buttons-->
            </div>
        </div>
    </div>
    <!--./page content-->
</div>
<?php 
	put_footer();
?>