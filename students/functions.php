<?php 
function profile_complete_progresbar($data){
    if($data['mname']==NULL && $data['dept_id']==NULL && $data['contact']==NULL && $data['e_contact']==NULL){
        echo "<div class='row'>
                    <div class='col-md-10'>
                        <div class='progress'>
                            <div class='progress-bar progress-bar-danger progress-bar-striped' role='progressbar'
                            aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' style='width:25%'>
                            25%
                            </div>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <a class='btn btn-sm btn-primary' href='complete-profile.php?st_id=".$data['st_id']."'>Complete Profile</a>
                    </div>
                </div>
                ";
    }
    
    else if($data['gr_name']==NULL && $data['gr_relation']==NULL && $data['gr_contact']==NULL){
        echo "<div class='row'>
                    <div class='col-md-10'>
                        <div class='progress'>
                            <div class='progress-bar progress-bar-warning progress-bar-striped' role='progressbar'
                            aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width:50%'>
                            50%
                            </div>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <a class='btn btn-sm btn-primary' href='complete-profile.php?st_id=".$data['st_id']."'>Complete Profile</a>
                    </div>
                </div>";
    }
    
    else if($data['pr_city']==NULL && $data['pr_state']==NULL && $data['pr_country']==NULL && $data['pr_pincode']==NULL){
        echo "<div class='row'>
                    <div class='col-md-10'>
                        <div class='progress'>
                            <div class='progress-bar progress-bar-info progress-bar-striped' role='progressbar'
                            aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:75%'>
                            75%
                            </div>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <a class='btn btn-sm btn-primary' href='complete-profile.php?st_id=".$data['st_id']."'>Complete Profile</a>
                    </div>
                </div>";
    }
    
    else if($data['fname']!=NULL && $data['mname']!=NULL && $data['lname']!=NULL && $data['email']!=NULL && $data['enrollment']!=NULL && $data['dept_id']!=NULL && $data['contact']!=NULL && $data['e_contact']!=NULL && $data['gr_name']!=NULL && $data['gr_relation']!=NULL && $data['gr_contact']!=NULL && $data['pr_address']!=NULL && $data['pr_city']!=NULL && $data['pr_state']!=NULL && $data['pr_country']!=NULL && $data['pr_pincode']!=NULL && $data['cr_address']!=NULL && $data['cr_city']!=NULL && $data['cr_state']!=NULL && $data['cr_country']!=NULL && $data['cr_pincode']!=NULL){

        echo "<div class=\"progress\">
                    <div class=\"progress-bar progress-bar-success progress-bar-striped active\" role=\"progressbar\"
                    aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:100%\">
                    Completed : 100%
                    </div>
                </div>";
    }
}

function pull_information($user_id,$enrollment,$key){
    $sql="SELECT * FROM eh_students WHERE st_id=$user_id AND enrollment='$enrollment'";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data[$key];
    }
}

function pull_course($c_id){
    $sql="SELECT * FROM eh_courses";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    $a=array();
    
    if(@mysqli_num_rows($query_result)>0){
        while($row=mysqli_fetch_assoc($query_result)){
            $a[$row['course_id']]=$row['c_name'];
        
        }
    }
    foreach ($a as $key => $value) {
        $bit='';
        if ($key==$c_id) {
            $bit='selected';
        }
        echo "<option value='".$key."' ".$bit.">".$value."</option>";
    }
}

function pull_semester($sem_id){
    $a=array();
    for($i=1;$i<=8;$i++){
        $a[$i]=$i;
    }    
    foreach ($a as $key => $value) {
        $bit='';
        if ($key==$sem_id) {
            $bit='selected';
        }
        echo "<option value='".$key."' ".$bit.">".$value."</option>";
    }
}

function pull_hostel_block_name($block_id){
    $sql="SELECT * FROM eh_blocks WHERE block_id=".$block_id;
    $query_result=mysqli_query(Database::getConnection(),$sql);
    
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
    }
    return $data['block_name'];
}

function pull_floor_name($floor_id){
    $sql="SELECT * FROM eh_floors WHERE floor_id=".$floor_id;
    $query_result=mysqli_query(Database::getConnection(),$sql);
    
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
    }
    return $data['floor_name'];
}

function url_friendly_file_path($path){
    require_once "../includes/functions.php";
    $striped_path=substr($path,3);
    return base_url($striped_path);
}

?>