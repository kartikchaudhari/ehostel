function openWindow(url,title){
    settings = "width=640, height=480, top=20, left=400px, scrollbars=no, location=no, directories=no, status=no, menubar=no, toolbar=no, resizable=no, dependent=no";
    win = window.open(url, title, settings);
    win.focus();
}

function viewSingleHostel(url){
	$('#modal-body-view').load(url,function(){
        $('#viewHostel').modal({show:true});
    });
}

function editSingleHostel(url){
	window.open(url,'window','width=500px,height=600px,left=400px,top=0px,titlebar=0');
}

function assignHostelId(id){
	$("#hostel_id").val(id);
}


function deleteHostel(ajax_url){
	//hide notice
   	$("#model-body-content").css('display', 'none');

   //display progrss
   $("#model-progress").css('display', 'block');
    
   $("#modal-footer").html('<button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
   $("#btnCancel").attr('disabled', 'disabled');
    $.post(ajax_url,
    {
        hostel_id:$("#hostel_id").val()

    }, 
    function(data, textStatus, xhr) {
      if(data==1){
      	//hide progress
      	$("#model-progress").css('display', 'none');

      	//display success message
      	$("#model-body-content").html('<h4 align="center">Deleted successfully</h4>');
      	$("#model-body-content").css('display', 'block');
      	$("#btnCancel").removeAttr('disabled');
      	
      	//refresh the page
      	location.reload();
      }

    });
}


function editSingleBlock(url){
  window.open(url,'window','width=500px,height=600px,left=400px,top=0px,titlebar=0');
}

function assignBlocklId(id){
  $("#block_id").val(id);
}

/*delete block*/
function deleteBlock(ajax_url){
  //hide notice
    $("#model-body-content").css('display', 'none');

   //display progrss
   $("#model-progress").css('display', 'block');
    
   $("#modal-footer").html('<button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
   $("#btnCancel").attr('disabled', 'disabled');
    $.post(ajax_url,
    {
        block_id:$("#block_id").val(),
        btnDeleteBlock:''

    }, 
    function(data, textStatus, xhr) {
      if(data==1){
        //hide progress
        $("#model-progress").css('display', 'none');

        //display success message
        $("#model-body-content").html('<h4 align="center">Deleted successfully</h4>');
        $("#model-body-content").css('display', 'block');
        $("#btnCancel").removeAttr('disabled');
        
        //refresh the page
        location.reload();
      }
    });
}

/*update admission dates*/
function duUpdateAdmissionDates(ajax_url){
  $.post(ajax_url,
    {
        action:"admission_dates",
        adm_start_date:$("#adm_start_date").val(),
        adm_end_date:$("#adm_end_date").val()
    }, 
    function(data, textStatus, xhr) {
      if(data==1){
        $("#msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Hostel admission Dates are Updated Successfully.</div>');
      }
      else{
        $("#msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error ! : <strong>'+data+'</div>');
      }
    });
}

/*update admission rules and instruction*/
function doUpdateAdmissionRulesInstructions(ajax_url){
    $.post(ajax_url,
    {
        admrules_inst:$("#admrules_inst").val()
    }, 
    function(data, textStatus, xhr) {
      if(data==1){
        $("#msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Admission Rules and Instructions are up-to-date.</div>');
      }
      else{
        $("#msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error ! : <strong>'+data+'</div>');      }
    });
}


/*update hostel rules*/
function doUpdateHostelRules(ajax_url){
    $.post(ajax_url,
    {
        hrules:$("#hrulescontent").val()
    }, 
    function(data, textStatus, xhr) {
      if(data==1){
        $("#msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Hostel Rules are Updated Successfully.</div>');
      }
      else{
        $("#msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error ! : <strong>'+data+'</div>');      }
    });
}


/*reset guard password*/
function resetGuardPassword(guard_id){
  $("#message").html('<img id="ajax-loader" src="'+base_url+'assets/images/ajax-loader.gif">');
}

function closeAndRefresh(){
  window.close();
  location.reload();
}

function theEditor(){
  $('.textarea').wysihtml5();
}





