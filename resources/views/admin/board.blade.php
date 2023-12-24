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
               <h5 class="m-b-10">Boards Info</h5>
            </div>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
               <li class="breadcrumb-item"><a href="#!">Add Board </a></li>
               <!-- <li class="breadcrumb-item"><a href="#!">Basic Tables</a></li> -->
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
         <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#boardModal" > <i class="fa-solid fa-plus"></i> Add New Board </button>
      </div>
      <div class="modal fade" id="boardModal" tabindex="-1" role="dialog" aria-labelledby="boardModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="boardModalLabel">Create Board</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
               <div class="modal-body">
                  <form id="addBoard" method="post">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="board_name" class="col-form-label">Board Name:</label>
                        <input type="text" class="form-control" id="board_name"  name="board_name">
                     </div>
                     <div class="form-group">
                        <label for="board_description" class="col-form-label"> Board Description:</label>
                        <textarea class="form-control" id="board_description" name="board_description"></textarea>
                     </div>
                     <div class="form-group">
                        <label for="board_status" class="col-form-label"> Board Status:</label>
                        <select class="form-control" name="board_status" id="board_status">
                           <option value="">--Select Status--</option>
                           <option value="Yes">Yes</option>
                           <option value="No">No</option>
                        </select>
                     </div>
                     <div class="modal-footer">
                        <input type="hidden" name="board_id" id="board_id" value="" />
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Board">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="card-body table-border-style">
         <div class="table-responsive">
            <span id="form_output"></span>
            <table class="table table-striped table-bordered"  id="Board_table" >
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Board Name</th>
                     <th>Board Description</th>
                     <th>Board Status</th>
                     <th>Created Date / Time</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
      <!-- Delete Board Modal -->
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
      <!-- End Board Modal -->
   </div>
</div>
<!-- [ stiped-table ] end -->
<!-- Footer -->
@include('admin.layouts.footer')
<script>
   $(document).ready(function() {
   
   fetchBoardData();
   
   function fetchBoardData()
   {
    $.ajax({
     url:"{{ route('getBoarddata') }}",
     dataType:"json",
     success:function(data)
     {
      var html = '';
      for(var count=0; count < data.length; count++)
      {
       html +='<tr>';
       html +='<td contenteditable class="column_name" data-column_name="board_id" data-id="'+data[count].board_id+'">'+data[count].board_id+'</td>';
       html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].board_id+'">'+data[count].board_name+'</td>';
       html += '<td contenteditable class="column_name" data-column_name="board_description" data-id="'+data[count].board_id+'">'+data[count].board_description+'</td>';
       html += '<td contenteditable class="column_name" data-column_name="board_status" data-id="'+data[count].board_id+'">'+data[count].board_status+'</td>';
       html += '<td contenteditable class="column_name" data-column_name="board_status" data-id="'+data[count].board_id+'">'+data[count].created_at+'</td>';
       // html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].board_id+'">Delete</button></td></tr>';
       html += '<td>';
       html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].board_id+'" data-toggle="modal"  title="Update Board Details"><i class="fas fa-edit"></i></button>';
       html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].board_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
       html += '</td></tr>';
   
   
      }
      $('tbody').html(html);
     }
    });
   }
   
   // $('#Board_table').DataTable({
   //         "processing": true,
   //         "serverSide": true,
   //         "ajax": "{{ route('getBoarddata') }}",
   //         "columns":[
   //             { "data": "board_id" },
   //             { "data": "board_name" },
   //             { "data": "board_description" },
   //             { "data": "board_status" },
   //             { "data": "created_at" },
   //             { "data": "action", orderable:false, searchable: false}
   //         ]
   // });
   
    $('#addBoard').on('submit', function(event){ 
       event.preventDefault();
       var form_data = $(this).serialize();
       $.ajax({ 
           url:"{{ route('addBoard') }}",
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
                       $('#addBoard')[0].reset();
                       $('#action').val('Add');
                       $('.modal-title').text('Add Data');
                       $('#button_action').val('insert');
                       $("#boardModal").modal("hide");
                       setInterval('location.reload()', 4000);   
                   }
               }
   
       });
    });
   
    var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
     var board_id = $(this).attr("data-id");
     if(confirm("Are you sure you want to delete this records?"))
     {
      $.ajax({
       url:"{{ route('deleteBoarddata') }}",
       method:"delete",
       data:{board_id:board_id, _token:_token},
       success:function(data)
       {
        $('#form_output').html(data);
        fetch_board_data();
       }
      });
     }
    });
     
   $(document).on('click', '.update', function(){
         var board_id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url:"{{route('fetchBoardData')}}",
            method:'get',
            data:{board_id:board_id},
            dataType:'json',
            success:function(data)
            {
                  $('#board_name').val(data.board_name);
                  $('#board_description').val(data.board_description);
                  $('#board_status').val(data.board_status);
                  $('#board_id').val(board_id);
                  $('#boardModal').modal('show');
                  $('#action').val('Update');
                  $('.modal-title').text('Edit Data');
                  $('#button_action').val('update');
            }
         })
   });
   
   });
</script>
</body>
</html>