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
                    <h5 class="m-b-10">Question Type (Total : <?php echo $question_type_count;?>)</h5>
                </div>
                <!-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Question Type Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Question Type Details</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ stiped-table ] start -->
<div class="col-xl-12">
    <div class="card">
        <div class="card-header text-right">
            <label><input type="checkbox" id="select_all" class="mt-2" style="cursor:pointer;"> Select All </label>
            <button type="button" id="delete_records" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete <span class="rows_selected" id="select_count">0 Selected</span></button>
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#questionTypeModal" > <i class="fa-solid fa-plus"></i> Add Question Type </button>
        </div>
        <div class="modal fade" id="questionTypeModal" tabindex="-1" role="dialog" aria-labelledby="questionTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="questionTypeModalLabel">Create Question Type</h5>
                        <button id="topicModalClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form id="addQuestiontype" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                           <div class="col-md-6 form-group">
                              <label for="qType" class="col-form-label">Question Type:</label>
                              <input type="text" class="form-control" id="qType"  name="qType">
                           </div>
                           <div class="col-md-6 form-group">
                              <label for="qType_status" class="col-form-label"> Question Type Status:</label>
                              <select class="form-control formField" name="qType_status" id="qType_status">
                                 <option value="">--Select Status--</option>
                                 <option value="Active">Active</option>
                                 <option value="InActive">InActive</option>
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="qType_id" id="qType_id" value="" />
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
                <table style="width: 100%;" class="table table-striped table-bordered data-table" id="topic_table">
                    <thead>
                        <tr>
                            <th style="width:10px !important;text-align:center"></th>
                            <th>Sr.No</th>
                            <th>Question Type</th>
                            <th>status</th>
                            <th>Create Date / Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
    $('#questionTypeModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    });
    //View/Get data in html format Here//
    getQuestionTypeAllData();
    function getQuestionTypeAllData()
    {
        $.ajax({
            url: base_url + "/admin/getQuestionTypeAllData",
            dataType:"json",
            success:function(data) {
                var html = '';
                for(var count=0; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_on);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);
                    html += '<td><input type="checkbox" class="selectQuestionTypeCheckbox" data-qType-id="' + data[count].qType_id + '"></td>';
                    html +='<td contenteditable class="column_name" data-column_name="qType_id" data-id="'+data[count].qType_id+'">'+data[count].qType_id+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type" data-id="'+data[count].qType_id+'">'+data[count].qType+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type_status" data-id="'+data[count].qType_id+'">'+data[count].qType_status+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].qType_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';
                    html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'+data[count].qType_id+'" data-toggle="modal"  title="Update Question Type Details"><i class="fas fa-edit"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].qType_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
                    html += '</td></tr>';
                }
                $('tbody').html(html);
                $('#topic_table').DataTable({
                    aaSorting: [[0, 'asc']],
                    "paging": true,
                    "pageLength": 10,
                    "bDestroy": true
                });
            }
        });
    }

    //Add Medium Using Ajax //
    $('#addQuestiontype').on('submit', function(event){ 
        event.preventDefault();
        var err = 0;
        if($("#board_id").val() == ''){
            err = 1;
        } else if($("#board_id").val() == ''){
            err = 1;
        } else if($("#medium_id").val() == ''){
            err = 1;
        } else if($("#class_id").val() == ''){
            err = 1;
        } else if($("#subject_id").val() == ''){
            err = 1;
        } else if($("#chapter_id").val() == ''){
            err = 1;
        } else if($("#topic_id").val() == ''){
            err = 1;
        } else if($("#question_type").val() == ''){
            err = 1;
        }

        if (err == 1){
            $('.formField').filter(function() {
                return this.value == ''
            }).css('border','1px solid #e60000'); //#495057
            return false;
        } else {
            var form_data = $(this).serialize();
            $.ajax({ 
                url: base_url + "/admin/addQuestionType",
                method:"POST",
                data:form_data,
                dataType:"json",
                success:function(data){
                    if(data.error.length > 0) {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    } else {
                        $('#form_output').html(data.success);
                        $('#addQuestiontype')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#questionTypeModal").modal("hide");
                        setInterval('location.reload()', 1000);   
                        //window.location.reload();
                    }
                }
            });
        }
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
         var qType_id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateQuestionTypeData",
            method:'post',
            data:{_token:_accessToken,qType_id:qType_id},
            dataType:'json',
            success:function(data)
            {
                $('#qType').val(data.qType);
                $('#qType_status').val(data.qType_status);
                $('#qType_id').val(qType_id);
                $('#questionTypeModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Edit Question TypeData');
                $('#button_action').val('update');
            }
         })
   });

   //Delete Medium Here//
   var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
     var qType_id = $(this).attr("data-id");
     if(confirm("Are you sure you want to delete this records?"))
     {
      $.ajax({
       url: base_url + "/admin/deleteQuestionTypeData",
       method:"delete",
       data:{qType_id:qType_id, _token:_token},
       success:function(data)
       {
        $('#form_output').html(data);
        setInterval('location.reload()', 1000); 
        fetchQuestionTypeData();
       }
      });
     }
   });


   $(document).on('click', '#select_all', function() {
     $(".selectQuestionTypeCheckbox").prop("checked", this.checked);
     $("#select_count").html($("input.selectQuestionTypeCheckbox:checked").length+" Selected");
   });
   $(document).on('click', '.selectQuestionTypeCheckbox', function() {
     if ($('.selectQuestionTypeCheckbox:checked').length == $('.selectQuestionTypeCheckbox').length) {
       $('#select_all').prop('checked', true);
     } else {
       $('#select_all').prop('checked', false);
     }
        $("#select_count").html($("input.selectQuestionTypeCheckbox:checked").length+" Selected");
   });
   
   $('#delete_records').on('click', function(e) {
     var question_type_delete = [];
     $(".selectQuestionTypeCheckbox:checked").each(function() {
      question_type_delete.push($(this).attr('data-qType-id'));
   
     });
     if(question_type_delete.length <=0) {
            alert("Please select records."); 
         }else{
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(question_type_delete.length>1?"these question type details":"this question type detail")+" ? \nNote:- After delete you can not access this data.";
            var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {
            var selected_values = question_type_delete.join(",");
            $.ajax({
               url: base_url + "/admin/deleteMultipleQuestionTypeData",
               method: 'post',
               data: {_token:_accessToken,qType_ids:selected_values},
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                  $('#delete_records').prop('disabled', true);
                  $('#form_output').html(response);
                  setInterval('location.reload()', 1000);
                  getQuestionTypeAllData();
               }
            });
         }
         }
   });  
});
</script>
</body>
</html>