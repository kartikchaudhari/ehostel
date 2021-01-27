<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('admin');
  $css=array("//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",base_url('assets/richtext/richtext.min.css'),);
  put_head("Settings :: Administrator",$css,true);
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
            $child="Settings";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <?php 
            /*pull global settings value*/
            $sql="SELECT * FROM eh_settings";
            $query=mysqli_query(Database::getConnection(),$sql);
            $result=mysqli_fetch_assoc($query);
        ?>

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">System Settings</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#dates" aria-controls="dates" role="tab" data-toggle="tab">Admission Dates</a>
                        </li>
                        <li role="presentation">
                            <a href="#admission_rules" aria-controls="admission_rules" role="tab" data-toggle="tab">Admission Rules and Instructions</a>
                        </li>
                        <li role="presentation">
                            <a href="#hrules" aria-controls="hrules" role="tab" data-toggle="tab">Hostel Rules</a>
                        </li>
                    </ul>
                        
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="dates">
                            <br>
                            <div class="form-group">
                                <label>Admission Start Date: </label> <span>(click in input field to populate calender, formt of selected date will be <code>dd-mm-yyyy</code>): </span>
                                <input class="form-control" id="adm_start_date" name="adm_start_date" type="text" value="<?=$result['registration_start']?>" />
                            </div>
                            <div class="form-group">
                                <label>Admission End Date: </label> <span>(click in input field to populate calender, formt of selected date will be <code>dd-mm-yyyy</code>): </span>
                                <input class="form-control" id="adm_end_date" name="adm_end_date" type="text" value="<?=$result['registration_end']?>"/>
                            </div>
                            <br>
                            <button type="button" class="btn btn-success" onclick="duUpdateAdmissionDates('<?=base_url('admin/settings/ajax.php')?>');">Submit</button>
                            <span>&nbsp;&middot;&nbsp;</span>
                            <button type="button" class="btn btn-danger">Reset</button>
                            <br><br>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="admission_rules">
                            <br>
                            <h4 class="text-danger">Note: The content written in this section is going to be displayed during the Student Registration proccess on Android application.</h4>
                            <br>
                            <textarea id="admrules_inst" class="form-control editor" required="required"><?=html_decoder($result['admission_rule_instruction']);?></textarea>
                            <br>
                            <button type="button" class="btn btn-success" onclick="doUpdateAdmissionRulesInstructions('<?=base_url('admin/settings/ajax.php')?>');">Submit</button>
                            <span>&nbsp;&middot;&nbsp;</span>
                            <button type="button" class="btn btn-danger">Reset</button>
                            <br><br>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="hrules">
                            <br>
                            <textarea id="hrulescontent" class="form-control editor" required="required"><?=html_decoder($result['hostel_rules_content']);?></textarea>
                            <br>
                            <button type="button" class="btn btn-success" onclick="doUpdateHostelRules('<?=base_url('admin/settings/ajax.php')?>');">Submit</button>
                            <span>&nbsp;&middot;&nbsp;</span>
                            <button type="button" class="btn btn-danger">Reset</button>
                            <br><br>
                        </div>
                        <!-- common alert container for all tabs -->
                        <div id="msg-alert"></div>
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
    $js="<script src='".base_url('assets/js/jquery-ui.min.js')."'></script>";
    $js.="<script>
            $( function() {
                $('#adm_start_date' ).datepicker({
                    duration: 'fast',
                    dateFormat:'dd-mm-yy'
                });
                $('#adm_end_date' ).datepicker({
                    duration: 'fast',
                    dateFormat:'dd-mm-yy'
                });
            });
        </script>";
    $js.="<script src='".base_url('assets/richtext/jquery.richtext.min.js')."'></script>";
    $js.="<script type='text/javascript'>
            $(document).ready(function() {
            $('#hrulescontent').richText();
            $('#admrules_inst').richText();
        });
    </script>";
    put_footer(false,$js); 
?>
