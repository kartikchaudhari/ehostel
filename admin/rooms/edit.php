<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>
<!-- page content-->
    <div id="page-wrapper" style="margin-top: -20px;">
        <!--content-->
        <?php 
            if (isset($_GET['room_id'])) {
                if (is_numeric($_GET['room_id'])) {
                    $sql="SELECT * FROM eh_rooms WHERE room_id=".$_GET['room_id'];
                    $query=mysqli_query(Database::getConnection(),$sql);
                    $result=mysqli_fetch_assoc($query);
                }
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Room Information : <?=$result['room_no'];?></h3>
                </div>
                <div class="panel-body">
                     <div id="message" style="display: none;"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success !</strong> Hostel Info updated</div></div>
        			<div class="table-responsive">
						<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td><strong>Room ID</strong></td>
                                        <td><input id="room_id" class="form-control" disabled="disabled" value="<?=$result['room_id']?>"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Room No.</strong></td>
                                        <td><input id="room_no" type="number" class="form-control" placeholder="Room Number (Ex. 1105)" title="Room No." tabindex="1" required="required" value="<?=$result['room_no']?>"></td>
                                    </tr>
                                   <tr>
                                        <td><strong>Total Seats</strong></td>
                                        <td><input id="total_seats" type="number" class="form-control" placeholder="Total Seats in Room" title="Total Seats"  tabindex="2" required="required" value="<?=$result['total_seat']?>"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Occupied Seats</strong></td>
                                        <td><?=$result['occupied_seat']?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hostel </strong></td>
                                        <td><select class="form-control hostel_name" id="hostel_name" required="required" tabindex="3">
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
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hostel Block</strong></td>
                                        <td>
                                            <select class="form-control hostel_block" id="hostel_block" required="required" tabindex="4">
                                                <option value="">-- Select Hostel Block --</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>                  
                        </form>
                         <center><button type="reset" class="btn btn-danger">Reset</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" id="btnUpdateHostel" class="btn btn-success" onclick="doSubmit()">Update</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" class="btn btn-primary" onclick="window.close();">Close</button></center>
                      </form>
                      <br>
					</div>		
                </div>
            </div>
        <?php
                    }
                ?>      
    </div>
    <!--./page content-->
<!-- footer -->
<?php
    put_js(); 
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.hostel_name').change(function(){
            var id=$(this).val();
            $.ajax({
                type: 'POST',
                url: '<?=base_url("admin/rooms/ajax.php")?>',
                data: {hostel_info_id:id,fetch_action:''},
                cache: false,
                success: function(data){
                    $('.hostel_block').html(data);
                } 
            });
        });
    });
    function doSubmit(){
      $.post('<?=base_url('admin/rooms/ajax.php');?>',
        {   
            room_id:<?=$_GET['room_id']?>,
            room_no:$("#room_no").val(),
            total_seats:$("#total_seats").val(),
            hostel_info_id:$("#hostel_name").val(),
            hostel_block:$("#hostel_block").val(),
            update_action:''

        }, 
        function(data, textStatus, xhr) {
            if(data==1){
              $("#message").css('display', 'block');
            }
            else{
              $("#message").html('<span>An error occcured while updation.</span>');
              $("#message").css('display', 'block');
            }
        });
    }

</script>
</body>
</html>