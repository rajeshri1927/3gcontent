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
               <h5 class="m-b-10">Boards Info (Total : <?php echo $board_count;?>)</h5>
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
         <label><input type="checkbox" id="select_all" class="mt-2" style="cursor:pointer;"> Select All Board </label>
         <button type="button" id="delete_records" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete <span class="rows_selected" id="select_count">0 Selected</span></button>
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
                        <label for="board_status" class="col-form-label"> Board Status:</label>
                        <select class="form-control" name="board_status" id="board_status">
                           <option value="">--Select Status--</option>
                           <option value="Active">Active</option>
                           <option value="InActive">InActive</option>
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
            <table class="table table-striped table-bordered data-table"  id="Board_table" >
               <thead>
                  <tr>
                     <th style="width:10px !important;text-align:center"></th>
                     <th>Sr.No</th>
                     <th>Board Name</th>
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
   
      fetchBoardAllData();
   
      function fetchBoardAllData()
      {
       $.ajax({
        url: base_url + "/admin/getBoardAllData",
        dataType:"json",
        success:function(data)
        {
         var html = '';
         for(var count=0; count < data.length; count++)
         {
            var createdAtDate = new Date(data[count].created_on);
            var options = { day: 'numeric', month: 'short', year: 'numeric' };
            var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);
          html +='<tr>'
          html += '<td><input type="checkbox" class="selectBoardCheckbox" data-board-id="' + data[count].board_id + '"></td>';
         //  html +='<td data-column_name="board_id" data-id="'+data[count].board_id+'">'+data[count].count+'</td>';
          html +='<td data-column_name="board_id" data-id="'+data[count].board_id+'">'+data[count].board_id+'</td>';
          html +='<td data-column_name="board_name" data-id="'+data[count].board_id+'">'+data[count].board_name+'</td>';
          html += '<td data-column_name="board_status" data-id="'+data[count].board_id+'">'+data[count].board_status+'</td>';
          html += '<td data-column_name="board_status" data-id="'+data[count].board_id+'">'+formattedCreatedAt+'</td>';
          // html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].board_id+'">Delete</button></td></tr>';
          html += '<td>';
          html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].board_id+'" data-toggle="modal"  title="Update Board Details"><i class="fas fa-edit"></i></button>';
          html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].board_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
          html += '</td></tr>';
      
      
         }
         $('tbody').html(html);
         var table =  $('#Board_table').DataTable({
            // "order": [[0, "ASC"]], 
            aaSorting: [[0, 'asc']],// Adjust the column index based on your actual table structure
            "paging": true,
            "pageLength": 50,
            "bDestroy": true,
            "autoWidth": false,
            "responsive": true,
         });
        }
       });
      }
   
   $(document).on('click', '#select_all', function() {
     $(".selectBoardCheckbox").prop("checked", this.checked);
     $("#select_count").html($("input.selectBoardCheckbox:checked").length+" Selected");
   });
   $(document).on('click', '.selectBoardCheckbox', function() {
     if ($('.selectBoardCheckbox:checked').length == $('.selectBoardCheckbox').length) {
       $('#select_all').prop('checked', true);
     } else {
       $('#select_all').prop('checked', false);
     }
     $("#select_count").html($("input.selectBoardCheckbox:checked").length+" Selected");
   });
   
   $('#delete_records').on('click', function(e) {
     var board_delete = [];
     $(".selectBoardCheckbox:checked").each(function() {
         board_delete.push($(this).attr('data-board-id'));
   
     });
     if(board_delete.length <=0) {
            alert("Please select records."); 
         }else{
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(board_delete.length>1?"these board details":"this board detail")+" ? \nNote:- After delete you can not access this data.";
            var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {
            var selected_values = board_delete.join(",");
            console.log(selected_values);
            //var board_name = $("#board_name").val();
            $.ajax({
               url: base_url + "/admin/deleteMultipleBoardData",
               method: 'post',
               data: {_token:_accessToken,board_ids:selected_values},
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                  $('#delete_records').prop('disabled', true);
                  $('#form_output').html(response);
                  setInterval('location.reload()', 1000);
                  fetchBoardAllData();
               }
            });
         }
         }
   });
   
   
      // function fetchBoardAllData() {
      //     var binfo = true;
      //     var paging = true;
         
      //     var table = $('.data-table').DataTable({
      //         "destroy": true,
      //         "processing": true,
      //         "serverSide": true,
      //         "ajax": {
      //             "url": base_url + "/admin/getBoardAllData",
      //             "data": function (d) {
      //                 // Include additional parameters if needed
      //                //d.search = $('#search').val();
      //             }
      //         },
      //         "bAutoWidth": false,
      //         "searching": true,
      //         "ordering": false,
      //         "bInfo": binfo,
      //         "bLengthChange": true,
      //         "paging": paging,
      //         "bPaginate": true,
      //         "pageLength": 10,
      //         "columns": [
      //             {data: 'board_id', name: 'board_id'},
      //             {data: 'board_name', name: 'board_name', className: "text-center"},
      //             // {data: 'board_description', name: 'board_description', className: "text-center"},
      //             {data: 'board_status', name: 'board_status', className: "text-center"},
      //             {data: 'created_at', name: 'created_at', className: "text-center"},
      //             {data: 'built_action_btns', name: 'built_action_btns', className: 'text-center'}
      //         ],
      //         "order": [[ 0, "desc" ]],
      //         fixedHeader: {
      //             header: true
      //         }
      //     });
   
      //     $.fn.dataTable.ext.errMode = 'none';
   
      //     $('.data-table').on('error.dt', function (e, settings, techNote, message) {
      //         console.log('An error has been reported by DataTables: ', message);
      //     });
      // }
         
       //Add Board Function Here//
       $('#addBoard').on('submit', function(event){ 
          event.preventDefault();
          var form_data = $(this).serialize();
          $.ajax({ 
              url: base_url + "/admin/addBoard",
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
          url: base_url + "/admin/deleteBoarddata",
          method:"delete",
          data:{board_id:board_id, _token:_token},
          success:function(data)
          {
           $('#form_output').html(data);
           setInterval('location.reload()', 1000);
           fetchBoardAllData();
          }
         });
        }
       });
         
      $(document).on('click', '.update', function(){
            var board_id = $(this).attr("data-id");
            $('#form_output').html('');
            $.ajax({
               url: base_url + "/admin/updateBoarddata",
               method:'post',
               data:{_token:_accessToken,board_id:board_id},
               dataType:'json',
               success:function(data)
               {
                     $('#board_name').val(data.board_name);
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