<style>
.text-padding{
padding-left: 20px;
}
</style>
		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Ticket > Ticket Details</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Ticket Details</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <?php  
                               // print_r($tickets);
                                	//foreach ($tickets as $ticket){?>
                                		
                                        <div class="form-body">
	                                        <div class="row">
		                                           <div class="col-md-4 center">
	                                           		 	<div class="col-md-4"><h3 class="box-title center">Assigned : </h3></div>
	                                           		 	<div class="col-md-6">
	                                           		 		<input type="hidden" id="ticketid" value="<?php echo $ticket['ticketid'];?>">
		                                           		 	<select class="selectize" id="executive_id" name="executive_id" onchange="assignExecutive(<?php echo $ticket['ticketid'];?>)" class="form-control"> 
	                                                        	<option value="" >Select Executive</option>
	                                                        	<?php foreach($Emps as $executive) {?>
	                                                        	<option  value="<?php echo $executive['id']; ?>" <?php if($executive['id']== $ticket['assigned_to']){ echo "selected";}?>><?php echo $executive['name']; ?></option>
	                                                        	<?php }?>
	                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
	                                                        <a title="View assigned history" href="javascript:viewgeneralHistory(<?php echo $ticket['ticketid']?>);"><i class="ti-search">&nbsp;Logs</i></a>
	                                           		 	</div>
	                                           		</div>
		                                           <div class="col-md-4 "> 
			                                            <div class="col-md-4 "> 
			                                          		<h3 class="box-title pull-right">Status :  </h3>
		                                           		</div>
		                                           		<div class="col-md-6">
			                                           		<select class="selectize capitalize" id="general_status_id" onchange="changeStatus(<?php echo $ticket['ticketid'];?>)" name="general_status_id" class="form-control"> 
		                                                       	<option value="" >Select general Status</option>
		                                                        <?php foreach($status as $row) {?>
		                                                        <option  value="<?php echo $row['id']; ?>" <?php if($row['id'] == $ticket['status_id']){echo "selected";} ?>><?php echo $row['name']; ?></option>
		                                                        <?php }?>
		                                                    </select>
	                                                    </div>
	                                                    <div class="col-md-2">
		                                                    <a title="View status history" href="javascript:viewStatusHistory(<?php echo $ticket['ticketid']?>);"><i class="ti-search">&nbsp;Logs</i> </a>
		                                           		</div>
		                                           </div>
		                                           <!-- Model --> 
		                                           <div class="col-md-4 "> 
			                                            <div class="col-md-4 "> 
			                                          		<h3 class="box-title pull-right">Priority :  </h3>
		                                           		</div>
		                                           		<div class="col-md-6">
	                                                         <!-- <select class="selectize" id="priority" name="priority" onchange="changePriority(<?php echo $ticket['ticketid'];?>)" class="form-control">  -->
	                                                         <select class="selectize" id="priority" name="priority"  class="form-control"> 
	                                                        		<option value="0" <?php if($ticket['priority'] == 0) { ?>selected<?php } ?>>Low</option>
													<option value="1" <?php if($ticket['priority'] == 1) { ?>selected<?php } ?>>Normal</option>
													<option value="2" <?php if($ticket['priority'] == 2) { ?>selected<?php } ?>>High</option>
													<option value="3" <?php if($ticket['priority'] == 3) { ?>selected<?php } ?>>Urgent</option>
	                                                        </select>
		                                           		</div>
		                                           		<div class="col-md-2 "> 
			                                          		<a title="View priority history" href="javascript:viewPriorityHistory(<?php echo $ticket['ticketid']?>);"><i class="ti-search">&nbsp;Logs</i></a>
		                                           		</div>
		                                           </div>
                                           </div>
                                            <hr>
                                            <?php foreach($tickets1 as $ticket1){ ?>
                                            <div class="row">
                                            	<div class="col-md-6 text-padding">
                                            	 	<div class="row">
                                                     	<p> Name : <?php echo $ticket1['name']; ?></p>
                                                     </div>
                                                    <div class="row">
                                                     	<p> Mobile : <?php echo $ticket1['mobile']; ?> </p>
                                                    </div>
                                                  
                                                     <div class="row">
                                                     	<p> Email : <?php echo $ticket1['email']; ?> </p>
                                                     </div>
                                                    
                                                </div>
                                                
                                            </div>
                                            <?php } ?>
                                            <!--/row-->
                                            <hr>
                                        </div>
                                        <div class="row">
                                        	<div class="col-md-12 col-lg-12 col-sm-12">
						                        <div class="white-box">
						                            <h3 class="box-title">Recent Comments</h3>
						                            <div class="comment-center" id="comments">
						                            	<?php 
						                            	if(!empty($comments)) { foreach($comments as $comment){?>
						                                <div class="comment-body col-md-12">
						                                    <div class="user-img"> <img src="<?php echo asset_url();?>images/user.png" alt="user" class="img-circle"></div>
						                                    <div class="mail-contnet" id="<?php echo "comment_".$comment['id']?>">
						                                        <h5><?php //echo $comment['first_name'].' '.$comment['last_name']; ?></h5>
				                                        	    <div class="col-md-12"><span class="mail-desc" id="msg_<?php echo $comment['id']; ?>"><?php echo $comment['comment'];?> </span></div>
				                                        	    <?php if(($_SESSION['adminsession']['id'] == $comment['created_by']) || ($_SESSION['adminsession'] == 1)){ ?><a href="javascript:editComment(<?php echo $comment['id'];?>);"><span class="label label-rouded label-info">Edit</span></a>
				                                        	   	 <a href="javascript:deleteComment(<?php echo $comment['id'];?>)"><span class="label label-rouded label-info">Delete</span></a>
				                                        	   	 <?php }  ?>
			                                        	        <span class="time pull-right"><?php echo $comment['created_datetime'];?></span>
		                                        	        </div>
						                                </div>
						                                 <!-- <div class="row" id="<?php echo "comment_".$comment['id']?>"></div>  -->
						                                <?php }} else {?>
						                                <h3>No Comments yet.</h3>
						                                
						                                <?php } ?>
						                            </div>
						                            <h3>Post your comment</h3>
						                            <div class="row">
						                            	<div class="col-md-12">
								                            <form method="post" name="comment-form" id="comment-form">
								                            	<div class="row">
								                            	<input type="hidden" id="comment_ticketid" name="comment_ticketid" value="<?php echo $ticket['ticketid'];?>">
					                                                <div class="col-md-12">
					                                                    <div class="form-group ">
					                                                        <label class="control-label">Message/Comment</label>
					                                                        <textarea rows="4" cols="10" required name="message" required id="message" class="form-control"></textarea>
					                                                     </div>
					                                                </div>
					                                          	</div>
						                                            <hr>
						                                        
						                                        <div class="form-actions">
						                                            <button type="submit"  class="btn btn-success"> <i class="fa fa-check"></i> Comment</button>
						                                        </div>
								                            </form>
							                            </div>
						                            </div>
						                          </div>
						                        </div>
						                    </div>
					                    </div>
                                    <?php //}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <!-- --Modals -->
           <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
               <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h4 class="modal-title">general Logs</h4>
                        </div>
                       <div class="modal-body" id="general_history">
                       </div>
                       <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                       </div>
                    </div>
                </div>
           </div>
           <!-- --Modals -->
           
           
           	<script src="<?php echo asset_url();?>backend/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo asset_url();?>backend/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo asset_url();?>backend/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	 <script>
	 <script>
	    $(document).ready(function() {
	        $('#myTable').DataTable();
	        $(document).ready(function() {
	            var table = $('#example').DataTable({
	                "columnDefs": [{
	                    "visible": false,
	                    "targets": 2
	                }],
	                "order": [
	                    [2, 'asc']
	                ],
	                "displayLength": 25,
	                "drawCallback": function(settings) {
	                    var api = this.api();
	                    var rows = api.rows({
	                        page: 'current'
	                    }).nodes();
	                    var last = null;

	                    api.column(2, {
	                        page: 'current'
	                    }).data().each(function(group, i) {
	                        if (last !== group) {
	                            $(rows).eq(i).before(
	                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
	                            );

	                            last = group;
	                        }
	                    });
	                }
	            });

	            // Order by the grouping
	            $('#example tbody').on('click', 'tr.group', function() {
	                var currentOrder = table.order()[0];
	                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
	                    table.order([2, 'desc']).draw();
	                } else {
	                    table.order([2, 'asc']).draw();
	                }
	            });
	        });
	    });
	    $('#example23').DataTable({
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ]
	    });
	    </script>
           
		<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$("#comment-form").on("submit", function(){
   var id = $("#comment_ticketid").val();
	$.post(base_url+"admin/general/comment", { ticketid :id,  comment: $("#message").val() }, function(data){
		$("#comments").html(data);
	},'html');
   return false;
 });
 
 function editComment(comment_id){
	 var comment = $('#msg_'+comment_id).text();
	 var html = '<div class="col-md-12">';
		 html += '<div class="form-group ">';
		 html += '<textarea rows="4" cols="10" required name="message" required id="updateMessage_'+comment_id+'" class="form-control">'+comment+'</textarea>';
		 html += '</div> <a href="javascript:updateComment('+comment_id+')"><span class="label label-rouded label-info">Update</span></a>';
	 	 html += '</div>';
 		$("#comment_"+comment_id).html(html);
 	 
 }
 
 function updateComment(comment_id){
	 var comment = $('#updateMessage_'+comment_id).val();
	 var id = $("#comment_ticketid").val();
		$.post(base_url+"admin/general/comment/update", { id:comment_id, ticketid :id,  comment: comment }, function(data){
			$("#comments").html(data);
			$("#message").value='';
		},'html');
 	 
 }
 function deleteComment(comment_id){
	 var comment = $('#updateMessage_'+comment_id).val();
	 var id = $("#comment_ticketid").val();
		$.post(base_url+"admin/general/comment/delete", { id:comment_id, ticketid :id }, function(data){
			$("#comments").html(data);
		},'html');
 	 
 }

 var pre_executive;
 $('#executive_id').focus(function() {
	 pre_executive = $(this).val();
 }).change(function() {
      $(this).blur() // Firefox fix as suggested by AgDude
     var success = confirm('Are you sure you want to assign this executive to another executive ?');
     if(success)
     {		
    	 	var ticketid = $("#ticketid").val();
			var user = $("#executive_id").val();
			$.post(base_url+"admin/general/assign/executive", { id:ticketid, user:user }, function(data){
				if(data.status == 1) {
					alert("Executive assigned succesfully.");
				} else {
					$("#profile_response").show();
					$("#profile_response").html(data.msg);
				}
		},'json');
	 }
     else
     {
         $('#executive_id').val(pre_executive);
         alert('Executive is same as earlier.');
         return false; 
     }
 });
	 
 var pre_status;
 $('#general_status_id').focus(function() {
	 pre_status = $(this).val();
 }).change(function() {
      $(this).blur() // Firefox fix as suggested by AgDude
     var success = confirm('Are you sure you want to change the Status ?');
     if(success)
     {		
    	 	var ticketid = $("#ticketid").val();
			var status = $("#general_status_id").val();
			$.post(base_url+"admin/general/change/status", { id:ticketid, status:status }, function(data){
				if(data.status == 1) {
					alert("Status Changed succesfully.");
				} else {
					$("#profile_response").show();
					$("#profile_response").html(data.msg);
				}
		},'json');
	 }
     else
     {
         $('#general_status_id').val(pre_status);
         alert('Status same as earlier.');
         return false; 
     }
 });
 
//  function changePriority(ticketid){
// 		var priority = $("#priority").val();
// 			$.post(base_url+"admin/general/change/priority", { id:ticketid, priority:priority }, function(data){
// 				if(data.status == 1) {
// 					alert("Priority Changed succesfully.");
// 				} else {
// 					$("#profile_response").show();
// 					$("#profile_response").html(data.msg);
// 				}
// 		},'json');
// 	 }


 
 var prev_val;

 $('#priority').focus(function() {
     prev_val = $(this).val();
     //alert(prev_val);
 }).change(function() {
      $(this).blur() // Firefox fix as suggested by AgDude
     var success = confirm('Are you sure you want to change the Priority ?');
     if(success)
     {		
    	 var ticketid = $("#ticketid").val();
         var priority = $("#priority").val();
         alert(priority);
			$.post(base_url+"admin/general/change/priority", { id:ticketid, priority:priority }, function(data){
				if(data.status == 1) {
					alert("Priority Changed succesfully.");
				} else {
					$("#profile_response").show();
					$("#profile_response").html(data.msg);
				}
		},'json');
     }  
     else
     {
         $('#priority').val(prev_val);
         alert('Priority same as earlier.');
         return false; 
     }
 });

 function viewgeneralHistory(ticketid){
	$.post(base_url+"admin/general/history/"+ticketid, {}, function(data){
		$("#general_history").html(data);
		$('#responsive-modal').modal('show');
	},'html');
	 
 }
 function viewStatusHistory(ticketid){
		$.post(base_url+"admin/general/status/history/"+ticketid, {}, function(data){
			$("#general_history").html(data);
			$('#responsive-modal').modal('show');
		},'html');
		 
	 }
 function viewPriorityHistory(ticketid){
		$.post(base_url+"admin/general/priority/history/"+ticketid, {}, function(data){
			$("#general_history").html(data);
			$('#responsive-modal').modal('show');
		},'html');
		 
	 }
</script>
