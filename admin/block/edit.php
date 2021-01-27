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
              <div id="message" style="display: none;"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success !</strong> Block Info updated</div></div>
               <?php 
                  if (isset($_GET['block_id'])) {
                     if (is_numeric($_GET['block_id'])) {

                         $sql = "SELECT eh_blocks.block_id,eh_blocks.block_name,eh_hostel_info.hostel_name,eh_hostel_info.info_id FROM eh_hostel_info LEFT JOIN eh_blocks ON eh_blocks.hostel_info_id= eh_hostel_info.info_id WHERE eh_blocks.block_id=".$_GET['block_id'];
                        $query=mysqli_query(Database::getConnection(),$sql);
                        $result=mysqli_fetch_assoc($query);
                     }
                     ?>
                     <div class="table-responsive">
                      <form>
                        <table class="table table-hover">
                          <tbody>
                              <tr>
                                <td><strong>Block Name</strong></td>
                                <td><input type="text" id="block_name" class="form-control" value="<?=$result['block_name']?>" required="required"></td>
                              </tr>
                              <tr>
                                <td><strong>Hostel Name</strong></td>
                                <td>
                                  <select class="form-control" id="hostel_id" required="required" tabindex="3">
                                      <option value="">-- Select Hostel--</option>
                                      <?php 
                                          $sql="SELECT * FROM eh_hostel_info";
                                          $query=mysqli_query(Database::getConnection(),$sql);
                                          if($query->num_rows>0){
                                            while($row=mysqli_fetch_assoc($query)){
                                              echo "<option value='".$row['info_id']."'>".$row['hostel_name']."</option>";
                                            }
                                          }
                                          else{
                                            echo "<option value=''> No Hostel Found </option>";
                                          }
                                      ?>
                                  </select>
                                </td>
                              </tr>
                        </table>
                        <center>
                          <button type="reset" class="btn btn-danger">Reset</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" id="btnUpdateBlock" class="btn btn-success" onclick="doSubmit()">Update</button>&nbsp;<strong>&middot;</strong>&nbsp;<button type="button" class="btn btn-primary" onclick="window.close();">Close</button></center>
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
  $.post('<?=base_url('admin/block/ajax.php');?>',
    {
      block_name:$("#block_name").val(),
      hostel_id:$("#hostel_id").val(),
      block_id:"<?=$_GET['block_id']?>",
      btnUpdateBlock:''

    }, 
    function(data, textStatus, xhr) {
        if(data==1){
          $("#message").css('display', 'block');
        }
        else{
          $("#message").html('<span>An error occcured while deletion.</span>');
          $("#message").css('display', 'block');
        }
    });

}

</script>
</body>
</html>