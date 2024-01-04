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
                            @if(!empty($BoardList))
                                @foreach($BoardList as $data)
                                    <option value="{{$data->board_id}}">{{$data->board_name}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="medium_id" class="col-form-label">Select Medium </label>
                            <select class="form-control formField" name="medium_id" id="medium_id">
                                <option value="">--- Select Medium ---</option>
                                @if(!empty($MediumList))
                                    @foreach($MediumList as $data)
                                        <option value="{{$data->medium_id}}">{{$data->medium}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="recipient-name" class="col-form-label">Class Name:</label>
                                <input type="text" class="form-control" id="class_name"  name="class_name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="medium_status" class="col-form-label"> Class Status:</label>
                                <select class="form-control" name="class_status" id="class_status">
                                    <option value="">--Select Status--</option>
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
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
                <table class="table table-striped table-bordered" id="standard_table">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Board Name</th>
                            <th>Medium Name</th>
                            <th>Class Name</th>
                            <th>Class Status</th>
                            <th>Create Date / Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
                  $('#medium_id').html('<option value="">--Select Medium--</option>');
                  $('#medium_id').append(result);
                }else{
                  $('#medium_id').html('<option value="">--No Medium--</option>');
                }
            }
        });

    });

    //View/Get data in html format Here//
   fetchClassData();
   function fetchClassData()
   {
    var binfo = true;
        var paging = true;
        var table = $('#standard_table').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url:  base_url + "/admin/getClassAllData",
                data: function (d) {
                }
            },
        bAutoWidth: false,
        searching: true,
        ordering: false,
        bInfo: binfo,
        bLengthChange: true,
        paging: paging,
        bPaginate: true,
        pageLength: 10,
        columns: [
            { data: 'class_id', name: 'class_details.class_id', className: 'text-center' },
            { data: 'board_name', name: 'board_details.board_name', className: 'text-center' },
            { data: 'medium', name: 'medium_details.medium', className: 'text-center' },
            { data: 'class_name', name: 'class_details.class_name', className: 'text-center' },
            { data: 'class_status', name: 'class_details.class_status', className: 'text-center' },
            { data: 'created_at', name: 'class_details.created_on', className: 'text-center' },
            { data: 'built_action_btns', name: 'built_action_btns', className: 'text-center' }
        ],
        order: [[6, 'desc']],  // Assuming you want to sort by 'created_at' column, adjust the index if needed
        fixedHeader: {
            header: true
        }
    });
    // Error handling
    $.fn.dataTable.ext.errMode = 'none';
    $('.data-table').on('error.dt', function (e, settings, techNote, message) {
        console.log('An error has been reported by DataTables: ', message);
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
            method:'post',
            data:{_token:_accessToken,class_id:class_id},
            dataType:'json',
            success:function(data)
            {
                $('#board_id').val(data.board_id);
                $('#medium_id').val(data.medium_id);
                $('#class_name').val(data.class_name);
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
            setInterval('location.reload()', 1000);   
            fetchClassData();
        }
        });
        }
    });
});
</script>
</body>
</html>