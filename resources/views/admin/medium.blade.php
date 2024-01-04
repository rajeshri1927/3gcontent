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
                    <div class="modal-body">
                        <form id="addMedium" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="medium" class="col-form-label">Medium Name:</label>
                                <input type="text" class="form-control" id="medium"  name="medium">
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
                                <option value="Active">Active</option>
                                <option value="InActive">InActive</option>
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
    var binfo = true;
        var paging = true;
        var table = $('#Medium_table').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url:  base_url + "/admin/getMediumAllData",
                data: function (d) {
                    
                    //console.log(data);
                    //d.search = $('#search').val()
                }
            },
            "bAutoWidth": false,
            "searching": true,
            "ordering": false,
            "bInfo": binfo,
            "bLengthChange": true,
            "paging": paging,
            "bPaginate": true,
            "pageLength": 10,
            columns: [
                {data: 'medium_id', name: 'medium_id'},
                {data: 'medium', name: 'medium',className: "text-center"},
                {data: 'board_name', name: 'boards.board_name', className: 'text-center' },
                {data: 'medium_status', name: 'medium_status',className: "text-center"},
                {data: 'created_at', name: 'created_at',className: "text-center"},
                {data: 'built_action_btns', name:'built_action_btns', className: 'text-center'}
            ],
            "order": [[ 0, "desc" ]],
            fixedHeader: {
                header: true
            }
        });
        $.fn.dataTable.ext.errMode = 'none';
        $('#Medium_table').on('error.dt', function (e, settings, techNote, message) {
            console.log('An error has been reported by DataTables: ', message);
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
            method:'post',
            data:{_token:_accessToken,medium_id:medium_id},
            dataType:'json',
            success:function(data)
            {
                  $('#medium').val(data.medium);
                  $('#board_id').val(data.board_id);
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
            setInterval('location.reload()', 4000);   
            fetchMediumData();
        }
        });
        }
    });
});
</script>
</body>
</html>