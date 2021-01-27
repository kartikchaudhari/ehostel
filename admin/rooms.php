<?php 
  session_start();
  require '../includes/functions.php';
  $css=array(   
                base_url('assets/datatable/datatables/css/jquery.dataTables.min.css'),
                "https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
                "https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"
            );

  is_logged_in('admin');
  put_head("Dashboard :: Administrator - Rooms",$css,true);
?>

<div id="wrapper">
    
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->

    <!-- page content-->
    <div id="page-wrapper">

        <!--breadcrumbs-->
        <?php 
            $root=array('url'=>base_url('admin/dashboard.php'),'text'=>'Dashboard');
            $child="Roos";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Manage Rooms</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                   <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#add" aria-controls="add" role="tab" data-toggle="tab"> <i class="fa fa-plus"></i> Add New Room</a>
                        </li>
                        <li role="presentation">
                            <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">
                                <i class="fa fa-cog"></i> Manage Rooms
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#import" aria-controls="import" role="tab" data-toggle="tab">
                                <i class="fa fa-upload"></i> Import Rooms
                            </a>
                        </li>
                    </ul>
               
                   <!-- Tab panes -->
                    <div class="tab-content">
                        
                        <!-- add new room-->
                        <div role="tabpanel" class="tab-pane active" id="add">
                            <!--the form-->
                            <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input name="room_no" type="number" class="form-control" placeholder="Room Number (Ex. 1105)" title="Room No." tabindex="1" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <input name="total_seat" type="number" class="form-control" placeholder="Total Seats in Room" title="Total Seats"  tabindex="2" required="required" value="3">
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <select class="form-control hostel_name" name="hostel_name" required="required" tabindex="3">
                                                <option value="">-- Select Hostel --</option>
                                                <?php 
                                                    $sql="SELECT * FROM eh_hostel_info";
                                                    $query=mysqli_query(Database::getConnection(),$sql);
                                                    if($query->num_rows>0){
                                                      while($row=mysqli_fetch_assoc($query)){
                                                        echo "<option value='".$row['info_id']."'>".$row['hostel_name']."</option>";
                                                      }
                                                    }
                                                    else{
                                                      echo "<option value=''> No Hostel Found</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control hostel_block" name="hostel_block" required="required" tabindex="4">
                                                <option value="">-- Select Hostel Block --</option>
                                            </select>
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="col-md-6">
                                            <button type="submit" class="btn btn-success" name="btnAddRooms" tabindex="5">Submit</button>
                                            &nbsp;<strong>&middot;</strong>&nbsp;
                                            <button type="reset" class="btn btn-danger" tabindex="6">Reset</button>
                                        </div>
                                   </div>
                               </div>
                           </form>
                           <!--./the form-->
                           <br>
                            <!--alert -->
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 

                                        if (isset($_POST['btnAddRooms'])) {
                                            $room_no=$_POST['room_no'];
                                            $sql="SELECT room_id,block_id,hostel_info_id FROM eh_rooms WHERE room_no=".$room_no;
                                            $query=mysqli_query(Database::getConnection(),$sql);
                                            if($query->num_rows>0){
                                                echo alert_style('danger','<strong>Error ! </strong> Room No. <strong>'.$room_no.'</strong> is already exist.');
                                            }
                                            else{
                                                $sql = "INSERT INTO eh_rooms (room_no,total_seat,block_id,hostel_info_id) VALUES ('".$_POST['room_no']."','".$_POST['total_seat']."','".$_POST['hostel_block']."','".$_POST['hostel_name']."')";
                                                    if(mysqli_query(Database::getConnection(),$sql)){
                                                    echo alert_style('success','<strong>Success ! </strong> Rooom is added successfully.');
                                                    
                                                    }
                                                    else{
                                                        echo alert_style('danger','<strong>Error Occured: </strong>'.mysqli_error(Database::getConnection()));
                                                    }
                                            }
                                        }
                                        prevent_resubmission();
                                    ?> 
                                </div>
                            </div>                          
                           <!--./alert -->
                        </div>
                        <!-- ./add new room -->

                        <!-- manage rooms -->
                        <div role="tabpanel" class="tab-pane" id="manage">
                            <br>
                            <table id="userTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Sr. No.</th>
                                        <th>Room No.</th>
                                        <th>Total Seats</th>
                                        <th>Occupied Seats</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql="SELECT * FROM eh_rooms";
                                        $query=mysqli_query(Database::getConnection(),$sql);
                                        $i=1;
                                        if ($query->num_rows>0) :
                                            while ($row=mysqli_fetch_assoc($query)):
                                    ?>
                                        <tr>
                                            <td align="center"><?=$i;?></td>
                                            <td align="center"><?=$row['room_no'];?></td>
                                            <td align="center"><?=$row['total_seat'];?></td>
                                            <td align="center"><?=$row['occupied_seat'];?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary">Select</button>
                                                    <button type="button" class="btn btn-success" onclick='openWindow("<?=base_url('admin/rooms/single.php?room_id='.$row['room_id']);?>","Room Info");'>View</button>
                                                    <button type="button" class="btn btn-info" onclick='openWindow("<?=base_url('admin/rooms/edit.php?room_id='.$row['room_id']);?>","Edit Room Info");'>Edit</button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteRoom(<?=$row['room_id'];?>)">Delete</button>
                                                </div> 
                                            </td>
                                        </tr>
                                    <?php
                                            $i++;
                                            endwhile;
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                       <!--./manage rooms-->

                        <!-- bulk import -->
                        <div role="tabpanel" class="tab-pane" id="import">
                            <br />
                            <h4 align="center">Import Room data from excel sheet (<code>.xls</code> or <code>..xlsx</code> allowed).</h4>
                            <h5 align="center" class="text-danger">Download Excel file Template from here. [<a href="<?=base_url('assets/sample-excel-sheets/rooms.xlsx');?>" title="click here to download">Download Here</a>]</h5>
                            <div class="table-responsive">
                                <span id="message"></span>
                                <form method="post" id="import_excel_form" enctype="multipart/form-data">
                                    <table class="table">
                                        <tr>
                                            <td width="25%" align="right">Select Excel File</td>
                                            <td width="50%"><input type="file" name="import_excel" /></td>
                                            <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Import" /></td>
                                        </tr>
                                    </table>
                                </form>
                                <br />              
                            </div>
                        </div>
                       <!--./bulk import-->
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
            $('#userTable').DataTable({
                mark: true,
                dom: 'lBfrtip',

                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print selected'
                    }
                ],
                select: true
            });
            $('#userTable_filter input').addClass('form-control');
            // $('#userTable_length select').addClass('form-control');

            $('#import_excel_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                  url:'".base_url('admin/rooms/import-rooms.php')."',
                  method:'POST',
                  data:new FormData(this),
                  contentType:false,
                  cache:false,
                  processData:false,
                  beforeSend:function(){
                    $('#import').attr('disabled', 'disabled');
                    $('#import').val('Importing...');
                  },
                  success:function(data)
                  {
                    $('#message').html(data);
                    $('#import_excel_form')[0].reset();
                    $('#import').attr('disabled', false);
                    $('#import').val('Import');
                  }
                })
            });

        });

        </script>";

    $js.="<script type='text/javascript'>
            $(document).ready(function(){
                $('.hostel_name').change(function(){
                    var id=$(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '".base_url('admin/rooms/ajax.php')."',
                        data: {hostel_info_id:id,fetch_action:''},
                        cache: false,
                        success: function(data){
                            $('.hostel_block').html(data);
                        } 
                    });
                         
                });
            });
            </script>";

    $js.='<script type="text/javascript">
            function deleteRoom(roomId){
                var sure=confirm("Are you sure you? \nYou can not restore the data after deletion. \nPress OK to continue or else press Cancel");
                if(sure==true){
                    $.post("'.base_url('admin/rooms/ajax.php').'",
                    {   
                        room_id:roomId,
                        delete_action:""

                    }, 
                    function(data, textStatus, xhr) {
                        if(data==1){
                            alert("Room deleted successfully");

                        }
                    });
                    document.reload;
                }

            }
        </script>';

    put_footer(false,$js); 
?>
