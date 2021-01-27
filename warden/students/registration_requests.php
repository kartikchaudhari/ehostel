<?php 
  session_start();
  require '../../includes/functions.php';
    $css=array(   
                base_url('assets/datatable/datatables/css/jquery.dataTables.min.css'),
                "https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
                "https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"
            );

  is_logged_in('warden');
  put_head("Dashboard :: Warden - Registration Requests",$css,true);
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
                            array('url'=>base_url('warden/students/registration_requests.php'),'text'=>'Registration Requests')
                        );
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">eHostel Registration Request</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending and Other Requests</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Approved Requests</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pending"><br>
                            <!-- pending requests-->
                            <?php 
                                $sql="SELECT * FROM eh_students WHERE account_status!=1";
                                $query=mysqli_query(Database::getConnection(),$sql);
                                if ($query->num_rows>0) {
                            ?>
                            <table id="pendingRequestTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Sr. No.</th>
                                        <th>Request ID</th>
                                        <th>Merit No.</th>
                                        <th>Student Name</th>
                                        <th>Admission Branch</th>
                                        <th>Cast</th>
                                        <th>Gender</th>
                                        <th>Date of Request</th>
                                        <th>Request Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        while($result=mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id'])?>" target="_blank"><?=$result['st_id']?></a></td>
                                        <td><?=$result['enrollment'];?></td>
                                        <td><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id'])?>" target="_blank"><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname']);?></a></td>
                                        <td><?=pull_dept_by_id($result['dept_id']);?></td>
                                        <td><?=pull_cast_by_id($result['cast_id']);?></td>
                                        <td><?=$result['gender']?></td>
                                        <td><?=$result['admission_date'];?></td>
                                        <td><?=request_status($result['account_status']);?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    Actions <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" style="width:100px;">
                                                    <li><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id']);?>">View</a></li>
                                                </ul>
                                            </div> 
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            <?php 
                                }
                                else{
                            ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <span>No Data Found</span>
                                </div>
                            <?php 
                                }
                            ?>
                            <!--./pending requests-->
                        </div>

                        <div role="tabpanel" class="tab-pane" id="tab"><br>
                            <!-- approved requests-->
                            <?php 
                                $sql="SELECT * FROM eh_students WHERE account_status=1";
                                $query=mysqli_query(Database::getConnection(),$sql);
                                if ($query->num_rows>0) {
                            ?>
                            <table id="approvedRequestTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Sr. No.</th>
                                        <th>Request ID</th>
                                        <th>Merit No.</th>
                                        <th>Student Name</th>
                                        <th>Admission Branch</th>
                                        <th>Cast</th>
                                        <th>Gender</th>
                                        <th>Date of Request</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        while($result=mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id'])?>" target="_blank"><?=$result['st_id']?></a></td>
                                        <td><?=$result['enrollment'];?></td>
                                        <td><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id'])?>" target="_blank"><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname']);?></a></td>
                                         <td><?=pull_dept_by_id($result['dept_id']);?></td>
                                        <td><?=pull_cast_by_id($result['cast_id']);?></td>
                                        <td><?=$result['gender']?></td>
                                        <td><?=$result['admission_date'];?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    Actions <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" style="width:100px;">
                                                    <li><a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id']);?>">View</a></li>
                                                </ul>
                                            </div> 
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            <?php 
                                }
                                else{
                            ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Title!</strong> Alert body ...
                                </div>
                            <?php 
                                }
                            ?>
                            <!--./approved requests-->
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
        <!--./content-->

    </div>
    <!--./page content-->
</div>
<!-- footer -->
<?php
    $js="<script src='".base_url('assets/datatable/datatables/js/jquery.dataTables.min.js')."'></script>";
     $js.="<script src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js'></script>
        <script src='https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js'></script>";
    $js.="<script>
        $(document).ready(function(){
            $('#pendingRequestTable').DataTable();
            $('#approvedRequestTable').DataTable({
                mark: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'print',
                        text: 'PDF',
                        title: 'Approved Requests'
                    },
                    {
                        extend: 'print',
                        text: 'Print selected',
                        title: 'Approved Requests'
                    }
                ],
                select: true
            });
            $('#approvedRequestTable_filter input').addClass('form-control');
        });
        </script>";
    put_footer(false,$js); 
?>
