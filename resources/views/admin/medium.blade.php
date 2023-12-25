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
                    <h5 class="m-b-10">Medium Here</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Medium Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Medium Details</a></li>
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
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#mediumModal" > <i class="fa-solid fa-plus"></i> Add New Medium </button>
        </div>
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Create Medium</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- <div class="modal-body">
                    <form>
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Medium Name:</label>
                            <select class="form-control" name="boardname" id="boardname">
                                <option value="">--Select Board--</option>
                                <option value="BOARD_BF9351DAA">CBSE</option>
                                <option value="BOARD_D50BE3EF0">ICSE</option>
                                <option value="BOARD_0040B44E3">JEE</option>
                                <option value="BOARD_F5DED60D5">MHCET</option>
                                <option value="BOARD_33E77AEF9">MHSB</option>
                                <option value="BOARD_2F32AB5FF">NEET</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Medium Name:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                    </div> -->
                    <div class="modal-body">
                        <form id="addMedium" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="medium_name" class="col-form-label">Medium Name:</label>
                                <input type="text" class="form-control" id="medium_name"  name="medium_name">
                            </div>
                            <div class="form-group">
                                <label for="medium_description" class="col-form-label"> Medium Description:</label>
                                <textarea class="form-control" id="medium_description" name="medium_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="medium_status" class="col-form-label"> Board Name:</label>
                                <select class="form-control" name="board_id" id="board_id">
                                    <option value="">--Select Board--</option>
                                    @foreach($BoardList as $data)
                                    <option value="{{$data->board_id}}">{{$data->board_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="medium_status" class="col-form-label"> Medium Status:</label>
                                <select class="form-control" name="medium_status" id="medium_status">
                                <option value="">--Select Status--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="medium_id" id="medium_id" value="" />
                                <input type="hidden" name="button_action" id="button_action" value="insert" />
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Medium">
                            </div>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn  btn-primary">Send message</button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="card-body table-border-style">
            <div class="table-responsive">
               <span id="form_output"></span>
                <table class="table table-striped table-bordered" id="Medium_table">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Medium Name</th>
                            <th>Board Name</th>
                            <th>Medium Description</th>
                            <th>Medium Status</th>
                            <th>Created Date/Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
	        </div>
        <!-- Delete Medium Modal -->
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
		
        <!-- End Medium Modal -->
    </div>
</div>
<!-- [ stiped-table ] end -->
<!-- Footer -->
@include('admin.layouts.footer')
<script>
$(document).ready(function() {
    
    //View/Get data in html format Here//
   fetchMediumData();
   function fetchMediumData()
   {
    $.ajax({
     url: base_url + "/admin/getMediumAllData",
     dataType:"json",
     success:function(data)
    {
      var html = '';
    for(var count=0; count < data.length; count++)
      {
        html +='<tr>';
        html +='<td contenteditable class="column_name" data-column_name="medium_id" data-id="'+data[count].medium_id+'">'+data[count].medium_id+'</td>';
        html +='<td contenteditable class="column_name" data-column_name="medium_name" data-id="'+data[count].medium_id+'">'+data[count].medium_name+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="board_id" data-id="'+data[count].medium_id+'">'+data[count].board_name+'</td>';
        html +='<td contenteditable class="column_name" data-column_name="medium_description" data-id="'+data[count].medium_id+'">'+data[count].medium_description+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="medium_status" data-id="'+data[count].medium_id+'">'+data[count].medium_status+'</td>';
        html += '<td contenteditable class="column_name" data-column_name="created_at" data-id="'+data[count].medium_id+'">'+data[count].created_at+'</td>';
        html += '<td>';
        html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].medium_id+'" data-toggle="modal"  title="Update Board Details"><i class="fas fa-edit"></i></button>';
        html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].medium_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
        html += '</td></tr>';
    }
      $('tbody').html(html);
    }
    });
   }

    //Add Medium Using Ajax //
    $('#addMedium').on('submit', function(event){ 
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({ 
            url: base_url + "/admin/addMedium",
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
                        $('#addMedium')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#mediumModal").modal("hide");
                        setInterval('location.reload()', 4000);   
                         //window.location.reload();
                    }
                }
    
        });
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
         var medium_id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetMediumData",
            method:'get',
            data:{medium_id:medium_id},
            dataType:'json',
            success:function(data)
            {
                  $('#medium_name').val(data.medium_name);
                  $('#board_id').val(data.board_id);
                  $('#medium_description').val(data.medium_description);
                  $('#medium_status').val(data.medium_status);
                  $('#medium_id').val(medium_id);
                  $('#mediumModal').modal('show');
                  $('#action').val('Update');
                  $('.modal-title').text('Edit Data');
                  $('#button_action').val('update');
            }
         })
   });

   //Delete Medium Here//
   var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var medium_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?"))
        {
        $.ajax({
        url: base_url + "/admin/deleteMediumData",
        method:"delete",
        data:{medium_id:medium_id, _token:_token},
        success:function(data)
        {
            $('#form_output').html(data);
            fetchMediumData();
        }
        });
        }
    });
});
</script>
</body>
</html>