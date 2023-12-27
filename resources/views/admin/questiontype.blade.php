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
               <h5 class="m-b-10">Question Type Info</h5>
            </div>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
               <li class="breadcrumb-item"><a href="#!">Add Question Type </a></li>
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
         <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#questionTypeModal" > <i class="fa-solid fa-plus"></i> Add New Question Type </button>
      </div>
      <div class="modal fade" id="questionTypeModal" tabindex="-1" role="dialog" aria-labelledby="questionTypeModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="questionTypeModalLabel">Create Question Type</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
               <div class="modal-body">
                  <form id="addQuestiontype" method="post">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="question_type" class="col-form-label">Question Type:</label>
                        <input type="text" class="form-control" id="question_type"  name="question_type">
                     </div>
                     <div class="form-group">
                        <label for="question_type_description" class="col-form-label"> Question Type Description:</label>
                        <textarea class="form-control" id="question_type_description" name="question_type_description"></textarea>
                     </div>
                     <div class="form-group">
                        <label for="question_type_status" class="col-form-label">  Question Type Status:</label>
                        <select class="form-control" name="question_type_status" id="question_type_status">
                           <option value="">--Select Status--</option>
                           <option value="Yes">Yes</option>
                           <option value="No">No</option>
                        </select>
                     </div>
                     <div class="modal-footer">
                        <input type="hidden" name="question_type_id" id="question_type_id" value="" />
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Question Type">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="card-body table-border-style">
         <div class="table-responsive">
            <span id="form_output"></span>
            <table class="table table-striped table-bordered"  id="question_type_table" >
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Question Type</th>
                     <th>Question Type Description</th>
                     <th>Question Type Status</th>
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
   
      fetchQuestionTypeData();
   
   function fetchQuestionTypeData()
   {
    $.ajax({
     url: base_url + "/admin/getQuestionTypeData",
     dataType:"json",
     success:function(data)
     {
      var html = '';
      for(var count=0; count < data.length; count++)
      {
       html +='<tr>';
      var createdAtDate = new Date(data[count].created_at);
      var options = { day: 'numeric', month: 'short', year: 'numeric' };
      var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);

       html +='<td contenteditable class="column_name" data-column_name="question_type_id" data-id="'+data[count].question_type_id+'">'+data[count].question_type_id+'</td>';
       html +='<td contenteditable class="column_name" data-column_name="question_type" data-id="'+data[count].question_type_id+'">'+data[count].question_type+'</td>';
       html += '<td contenteditable class="column_name" data-column_name="question_type_description" data-id="'+data[count].question_type_id+'">'+data[count].question_type_description+'</td>';
       html += '<td contenteditable class="column_name" data-column_name="question_type_status" data-id="'+data[count].question_type_id+'">'+data[count].question_type_status+'</td>';
      //  html += '<td contenteditable class="column_name" data-column_name="created_at" data-id="'+data[count].question_type_id+'">'+data[count].created_at+'</td>';
       // html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].question_type_id+'">Delete</button></td></tr>';
       html += '<td data-column_name="created_at" data-id="' + data[count].question_type_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
       html += '<td>';
       html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].question_type_id+'" data-toggle="modal"  title="Update Question Type Details"><i class="fas fa-edit"></i></button>';
       html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].question_type_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
       html += '</td></tr>';
      }
      $('tbody').html(html);
      $('#question_type_table').DataTable({
          // DataTables configuration options here
          "order": [[0, "desc"]], // Example: Sort by the first column (subject_id) in descending order
          "paging": true,
          "pageLength": 10,
          "bDestroy": true
      });
     }
    });
   }

    $('#addQuestiontype').on('submit', function(event){ 
       event.preventDefault();
       var form_data = $(this).serialize();
       $.ajax({ 
           url: base_url + "/admin/addQuestionType",
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
                       $('#addQuestiontype')[0].reset();
                       $('#action').val('Add');
                       $('.modal-title').text('Add Question Type Data');
                       $('#button_action').val('insert');
                       $("#questionTypeModal").modal("hide");
                       setInterval('location.reload()', 4000);   
                   }
               }
   
       });
    });
   
    var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
     var question_type_id = $(this).attr("data-id");
     if(confirm("Are you sure you want to delete this records?"))
     {
      $.ajax({
       url: base_url + "/admin/deleteQuestionTypeData",
       method:"delete",
       data:{question_type_id:question_type_id, _token:_token},
       success:function(data)
       {
        $('#form_output').html(data);
        fetchQuestionTypeData();
       }
      });
     }
    });
     
   $(document).on('click', '.update', function(){
         var question_type_id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateQuestionTypeData",
            method:'get',
            data:{question_type_id:question_type_id},
            dataType:'json',
            success:function(data)
            {
                  $('#question_type').val(data.question_type);
                  $('#question_type_description').val(data.question_type_description);
                  $('#question_type_status').val(data.question_type_status);
                  $('#question_type_id').val(question_type_id);
                  $('#questionTypeModal').modal('show');
                  $('#action').val('Update');
                  $('.modal-title').text('Edit Question TypeData');
                  $('#button_action').val('update');
            }
         })
   });
   
   });
</script>
</body>
</html>