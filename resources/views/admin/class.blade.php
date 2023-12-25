<!-- Main Header -->
@include('admin.layouts.header')
  <!-- Sidebar -->
  @include('admin.layouts.sidebar')
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
<div class="pcoded-content">
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Class Here</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Class Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Class Details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ stiped-table ] start -->
<div class="col-xl-12">
    <div class="card">
        <div class="card-header text-right">
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#classModal" > <i class="fa-solid fa-plus"></i> Add New Class </button>
        </div>
        <div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="classModalLabel">Create Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form id="addClass" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="recipient-name" class="col-form-label">Select Board </label>
                            <select class="form-control" name="board_id" id="board_id">
                            <option value="">--Select Board--</option>
                                @foreach($BoardList as $data)
                                    <option value="{{$data->board_id}}">{{$data->board_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="recipient-name" class="col-form-label">Select Medium </label>
                            <select class="form-control" name="medium_id" id="medium_id"></select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="recipient-name" class="col-form-label">Class Name:</label>
                                <input type="text" class="form-control" id="class_name"  name="class_name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="class_description" class="col-form-label">Class Description:</label>
                                <input typ="text" class="form-control" id="class_description" name="class_description">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="medium_status" class="col-form-label"> Class Status:</label>
                            <select class="form-control" name="class_status" id="class_status">
                                <option value="">--Select Status--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="class_id" id="class_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Class">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-border-style">
            <div class="table-responsive">
            <span id="form_output"></span>
                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Board Name</th>
                            <th>Medium Name</th>
                            <th>Class Name</th>
                            <th>Class Description</th>
                            <th>Create Date / Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>18 Dec 2023 11.30 PM</td>
                            <td>
                                <button class="btn btn-sm btn-warning mt-1" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" data-toggle="modal" data-target="#editModal" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" data-toggle="modal" data-target="#deleteModal" onclick="deleteClassDetail(this);" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>18 Dec 2023 11.30 PM</td>
                            <td>
                                <button class="btn btn-sm btn-warning mt-1" data-toggle="modal" data-target="#editModal" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" data-toggle="modal" data-target="#deleteModal" onclick="deleteClassDetail(this);" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>18 Dec 2023 11.30 PM</td>
                            <td>
                                <button class="btn btn-sm btn-warning mt-1" data-toggle="modal" data-target="#editModal" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" onclick="deleteClassDetail(this);" data-toggle="modal" data-target="#deleteModal" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
	    </div>
        <!-- Delete Class Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
						<p>Do you really want to delete these records?</p>
					</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn  btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal HTML -->
		
        <!-- End Class Modal -->
    </div>
</div>
<!-- [ stiped-table ] end -->
<!-- Footer -->
@include('admin.layouts.footer')
<script>
$(document).ready(function() {
    $('#board_id').on('change', function(event){ 
        event.preventDefault();
        var board_id = this.value;
        $.ajax({
            url: base_url + "/admin/getMediums",
            method:"GET",
            data:{board_id:board_id},
            success:function(result)
            {
                if(result)
                {
                  $('#medium_id').html('<option value="">Select Medium</option>');
                  $('#medium_id').append(result);
                }else{
                  $('#medium_id').html('<option value="">No Medium</option>');
                }
            }
        });

    });
    //View/Get data in html format Here//
   fetchClassData();
   function fetchClassData()
   {
    $.ajax({
     url: base_url + "/admin/getClassAllData",
     dataType:"json",
     success:function(data)
    {
      var html = '';
    for(var count=0; count < data.length; count++)
      {
        html +='<tr>';
        html +='<td contenteditable class="column_name" data-column_name="class_id" data-id="'+data[count].class_id+'">'+data[count].class_id+'</td>';
        html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].class_id+'">'+data[count].board_name+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="medium_name" data-id="'+data[count].class_id+'">'+data[count].medium_name+'</td>';
        html +='<td contenteditable class="column_name" data-column_name="class_description" data-id="'+data[count].class_id+'">'+data[count].class_description+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="class_status" data-id="'+data[count].class_id+'">'+data[count].class_status+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="created_at" data-id="'+data[count].class_id+'">'+data[count].created_at+'</td>';
        html += '<td>';
        html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].class_id+'" data-toggle="modal"  title="Update Class Details"><i class="fas fa-edit"></i></button>';
        html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].class_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
        html += '</td></tr>';
    }
      $('tbody').html(html);
    }
    });
   }

    //Add Medium Using Ajax //
    $('#addClass').on('submit', function(event){ 
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({ 
            url: base_url + "/admin/addClass",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
                {
                    if(data.error.length > 0)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    }
                    else
                    {
                        $('#form_output').html(data.success);
                        $('#addClass')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#classModal").modal("hide");
                        setInterval('location.reload()', 4000);   
                         //window.location.reload();
                    }
                }
    
        });
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
         var class_id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetClassData",
            method:'get',
            data:{class_id:class_id},
            dataType:'json',
            success:function(data)
            {
                $('#board_id').val(data.board_id);
                $('#medium_id').val(data.medium_id);
                $('#class_name').val(data.class_name);
                $('#class_description').val(data.class_description);
                $('#class_status').val(data.class_status);
                $('#class_id').val(class_id);
                $('#classModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
         })
   });

   //Delete Medium Here//
   var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var class_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?"))
        {
        $.ajax({
        url: base_url + "/admin/deleteClassData",
        method:"delete",
        data:{class_id:class_id, _token:_token},
        success:function(data)
        {
            $('#form_output').html(data);
            fetchClassData();
        }
        });
        }
    });
});
</script>
</body>
</html>