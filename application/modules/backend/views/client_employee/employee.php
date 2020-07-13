
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css"> 

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Role</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Role</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <!--   <div class="panel-heading">Category</div>-->
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-body">
                                <ul class="nav customtab nav-tabs" role="tablist">
                                    <li role="presentation" class="nav-item">
                                        <a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Role</span></a>
                                    </li>
                                    <li role="presentation" class="nav-item">
                                        <a href="#image" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Employee</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="basic" role="tabpanel"
                                         class="tab-pane fade in active show" aria-expanded="true">
                                        <div id="">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    
                                                    <div class="panel panel-default" id="role_add" style="display:none">
                                                        <div class="panel-heading">Add Role
                                                        <div class=" pull-right  btn-plus">
                                                        <a href="javascript: back('#role');" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> Back</a>
                                                    </div>
                                                        </div>
                                                            <div class="panel-body">
                                                                <form autocomplete="off" id="add_role" name="add_role" action="" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" id="error-name">
                                                                            <label class="control-label">Role<span class='text-danger'>*</span></label>
                                                                            <input type="text" class="form-control" id="name" name="name" />
                                                                        </div>
                                                                        <div class="messageContainer"></div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group" id="error-name">
                                                                            <label class="control-label">Status <span class='text-danger'>*</span></label>
                                                                            <select id="status" class="form-control" name="status">
                                                                                <option value="1">Enable</option>
                                                                                <option value="0">Disable</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="messageContainer"></div>
                                                                    </div>

                                                                </div> 

                                                                <div class="text-center">
                                                                    <div id="response"></div>
                                                                    <input type="hidden" id="id" name="id">
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                    <br>
                                                                </div>
                                                                </form>    
                                                            </div>
                                                        </div>

                                                    <div class="panel panel-default" id="role_list">
                                                        <div class="panel-heading">Role List
                                                        <div class=" pull-right  btn-plus">
                                                        <a href="javascript: add('#role');" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> <i class="fa fa-plus"></i>Role</a>
                                                    </div>
                                                        </div>
                                                        
                                                        <div class="panel-body">
                                                            <div class="dataTable_wrapper">
                                                                <table class="table table-striped table-bordered table-hover" id="tblcategory">
                                                                    <thead class="bg-info">
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Role</th>
                                                                            <th> Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody> 
                                                                        <?php if (isset($Roles)) { ?>
                                                                        <?php $i=1 ;foreach ($Roles as $role) {?>
                                                                        <tr id="role_id_<?= $role['id']?>">
                                                                            <td>
                                                                                <?php echo $i; ?>
                                                                             </td>   
                                                                             <td>
                                                                                <?= $role['name']?>	 
                                                                            </td>
                                                                            <td>
                                                                                <?= $role['status'] == 1 ? 'Enable' : 'Disable'?>	
                                                                             </td>   
                                                                            <td>
                                                                                <a href="javascript: edit(<?= $role['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color: white;"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $i++; }?> 
                                                                        <?php } else { ?>
                                                                        <tr>
                                                                            <td colspan="4">Records not found.</td>
                                                                        </tr>
                                                                        <?php }?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image" role="tabpanel" class="tab-pane fade" aria-expanded="true">
                                        <div id="">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="pull-right btn-plus">
                                                        <a href="javascript: addemployee();" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> <i class="fa fa-plus"></i>
                                                            Employee
                                                        </a>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">Employee List</div>
                                                         <div class="panel-body">
                                                            <div class="dataTable_wrapper">
                                                                <table class="table table-striped table-bordered table-hover" id="tblcategory">
                                                                    <thead class="bg-info">
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Client Name</th>
                                                                            <th>Outlet Names</th> 
                                                                            <th>First Name</th> 
                                                                            <th>Last Name</th>
                                                                            <th>Mobile</th> 
                                                                            <th>Email</th> 
                                                                            <th>Role</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (isset($Emps)) { ?>
                                                                    <?php $i=1; foreach ($Emps as $item) {?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $i;?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $item['client_name'];?>
                                                                        </td>
                                                                        <td style="width:40px; word-wrap:break-word;">  
                                                                         <?php 
                                                                         if($item['outlet_id']!='') {
                                                                                
                                                                                $outlet_names = [];
                                                                         foreach ($Outlets as $outlet) { 
                                                                                    $outlet_id_array = explode(',', $item['outlet_id']);
                                                                                    if (in_array($outlet['id'], $outlet_id_array)) { 
                                                                                            $outlet_names[] = $outlet['outlet_name']; 
                                                                                    }
                                                                                } 
                                                                                echo implode(',', $outlet_names);
                                                                            }
                                                                          ?> 
                                                                        </td>  
                                                                        <td>
                                                                            <?php echo $item['first_name'];?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $item['last_name'];?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $item['mobile'];?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $item['email'];?>
                                                                        </td> 
                                                                        <td>
                                                                            <?php echo $item['user_role'];?>
                                                                        </td> 
                                                                        <td><a href="javascript: editemployee(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs">
                                                                                <i class="fa fa-pencil" style="color: white;"></i>
                                                                            </a> 
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; }?>
                                                                    <?php } else { ?>
                                                                    <tr>
                                                                        <td colspan="4">Records not found.</td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
  function add(div) {
    $(div + '_add').show(400);
    $(div + '_list').hide();
    $('#add_role')[0].reset();
   }
   function back(div) {
    $(div + '_add').hide();
    $(div + '_list').show(400);
   }
   
   $('#add_role').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'Role is required and cannot be empty'
                }
            }
        },
        status: {
            validators: {
                notEmpty: {
                    message: 'Status is required and cannot be empty'
                }
            }
        },
       
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	$.ajax({
            url : base_url + 'client/role/add_update_role',
            data : $('#add_role').serialize(),
            dataType : 'JSON',
            type : 'POST',
            success : function(response){
                showresponse(response);
            }
        });
        return false;
});

function showresponse(response) {
    alert(response.msg);
    if (response.status == 1) {
        location.reload();
    }
} 

/*function edit_role(id) {
   $.ajax({
            url : base_url + 'client/role/edit/' + id,
            dataType : 'JSON',
            type : 'GET',
            success : function(response){
                showresponse(response);
            }
        });
        //return false;
}*/
function edit(id){ 
    $.post(base_url+"client/role/edit",{id: id},function(data) {
        $("#basic").html(data);
    },'html');
}   
function addemployee(){ 
    $.post(base_url+"client/emp/new",{},function(data) { 
        $("#image").html(data);
    },'html');
}
function editemployee(id){ 
    $.post(base_url+"client/emp/edit",{id: id},function(data) {
        $("#image").html(data);
    },'html');
}



</script>    