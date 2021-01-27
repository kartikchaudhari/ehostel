<?php 
  session_start();
  require '../includes/functions.php';
  $css=array(   
                base_url('assets/datatable/datatables/css/jquery.dataTables.min.css'),
                "https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
                "https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"
            );

  is_logged_in('admin');
  put_head("Visitor Book :: Administrator",$css,true);
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
            $child="Visitor Book";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Visitor Book</h3>
            </div>
            <div class="panel-body">
                <br>
                <table id="userTable" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr class="active">
                            <th>Sr. No.</th>
                            <th>Visitor Name</th>
                            <th>Visitor UID</th>
                            <th>Visited Room No.</th>
                            <th>Visited Person</th>
                            <th>In Time</th>
                            <th>Visit Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT * FROM `eh_visitors` ORDER BY `visit_date` DESC";
                            $query=mysqli_query(Database::getConnection(),$sql);
                            $i=1;
                            if ($query->num_rows>0) :
                                while ($row=mysqli_fetch_assoc($query)):
                        ?>
                            <tr>
                                <td align="center"><?=$i;?></td>
                                <td align="center"><?=$row['visitor_name'];?></td>
                                <td align="center"><?=$row['visitor_uid'];?></td>
                                <td align="center"><?=$row['room_no'];?></td>
                                <td align="center"><?=$row['visited_person_name'];?></td>
                                <td align="center"><?=$row['in_time'];?></td>
                                <td align="center"><?=$row['visit_date'];?></td>
                                <td align="center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Select</button>
                                        <button class="btn btn-success" onclick='openWindow("<?=base_url('admin/visitors/single.php?entry_id='.$row['visitor_id']);?>","Single Visior Entry Info");'>View</button>
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
        });
        </script>";
    put_footer(false,$js); 
?>
