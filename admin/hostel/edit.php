<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>
<!-- page content-->
    <div id="page-wrapper">
        <!--content-->
        
        <div class="panel panel-info">
            <div class="panel-body">
              <div id="message" style="display: none;"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success !</strong> Hostel Info updated</div></div>
               <?php 
                  if (isset($_GET['hostel_id'])) {
                     if (is_numeric($_GET['hostel_id'])) {
                        $sql="SELECT * FROM eh_hostel_info WHERE info_id=".$_GET['hostel_id'];
                        $query=mysqli_query(Database::getConnection(),$sql);
                        $result=mysqli_fetch_assoc($query);
                     }
                     ?>
                     <div class="table-responsive">
                      <form>
                        <table class="table table-hover">
                          <tbody>
                             <tr>
                                <td><strong>Hostel Name</strong></td>
                                <td><input type="text" id="hostel_name" class="form-control" value="<?=$result['hostel_name']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Total Rooms</strong></td>
                                <td><input type="number" id="total_rooms" class="form-control" value="<?=$result['total_rooms']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Capacity</strong></td>
                                <td><input type="number" id="capacity" class="form-control" value="<?=$result['capacity']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Guest Rooms</strong></td>
                                <td><input type="number" id="guest_rooms" class="form-control" value="<?=$result['guest_rooms']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>T.V Rooms</strong></td>
                                <td><input type="number" id="tv_rooms" class="form-control" value="<?=$result['tv_rooms']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Mess</strong></td>
                                <td><input type="number" id="mess_count" class="form-control" value="<?=$result['mess_count']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Reading Rooms</strong></td>
                                <td><input type="number" id="reading_rooms" class="form-control" value="<?=$result['reading_rooms']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Office Rooms</strong></td>
                                <td><input type="number" id="office_rooms" class="form-control" value="<?=$result['office_rooms']?>" required="required"></td>
                             </tr>
                             <tr>
                                <td><strong>Hostel Status</strong></td>
                                <td>
                                  <select id="hostel_status" class="form-control" required="required">
                                    <?php 
                                      if($result['hostel_status']==1){
                                          echo "
                                                <option value='1' selected='selected'>Acivated</option>
                                                <option value='0'>Not Acivated</option>
                                          ";
                                      }
                                      else{
                                          echo "
                                                <option value='0' selected='selected'>Not Acivated</option>
                                                <option value='1'>Acivated</option>
                                          "; 
                                      }
                                    ?>
                                  </select>
                                </td>
                             </tr>
                        </table>
                        <center><button type="reset" class="btn btn-danger">Reset</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" id="btnUpdateHostel" class="btn btn-success" onclick="doSubmit()">Update</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" class="btn btn-primary" onclick="window.close();">Close</button></center>
                      </form>
                  </div>      
                <?php
                  }
               ?>
            </div>
        </div>        
        <!--content-->
    </div>
    <!--./page content-->
<!-- footer -->
<?php
    put_js(); 
?>
<script type="text/javascript">
function doSubmit(){
  $.post('<?=base_url('admin/hostel/ajax.php');?>',
    {
        hostel_name:$("#hostel_name").val(),
        total_rooms:$("#total_rooms").val(),
        capacity:$("#capacity").val(),
        guest_rooms:$("#guest_rooms").val(),
        tv_rooms:$("#tv_rooms").val(),
        mess_count:$("#mess_count").val(),
        reading_rooms:$("#reading_rooms").val(),
        office_rooms:$("#office_rooms").val(),
        hostel_status:$("#hostel_status").val(),
        info_id:"<?=$_GET['hostel_id']?>",
        btnUpdateHostel:''

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