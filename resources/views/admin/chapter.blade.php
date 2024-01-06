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
          <h5 class="m-b-10">Chapter Here ( Total : <?php echo $chapter_count;?>)</h5>
        </div>
        <!-- <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">Chapter Info</a></li>
          <li class="breadcrumb-item"><a href="#!">Chapter Details</a></li>
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
        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#chapterModal" > <i class="fa-solid fa-plus"></i> Add Chapter </button>
    </div>
    <div class="modal fade" id="chapterModal" tabindex="-1" role="dialog" aria-labelledby="chapterModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="chapterModalLabel">Create Chapter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form role="form" id="addChapter" name="addChapter" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="boardname">Select Board</label>
                      <select class="form-control" name="board_id" id="board_id">
                          <option value="">--Select Board--</option>
                          @foreach($BoardList as $data)
                          <option value="{{$data->board_id}}">{{$data->board_name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="medium_id">Medium</label>
                      <select class="form-control" name="medium_id" id="medium_id">
                        <option value="">--Select Medium--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="class_id">Select Class</label>
                      <select class="form-control" id="class_id" name="class_id">
                        <option value="">--Select Class--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="subject_id">Subject Name</label>
                      <select class="form-control" id="subject_id" name="subject_id">
                        <option value="">--Select Subject--</option>
                     </select>
                      <!-- <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="Enter subject name. *"> -->
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="chapter_no">Chapter No.</label>
                      <input type="text" name="chapter_no" id="chapter_no" class="form-control" placeholder="Enter Chapter Number.*">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="chapter_name">Chapter Name </label>
                      <input type="text" name="chapter_name" id="chapter_name" class="form-control" placeholder="Enter Chapter Description. *">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="chapter_status">Subject Status</label>
                      <select class="form-control" name="chapter_status" id="chapter_status">
                          <option value="">--Select Status--</option>
                          <option value="Active">Active</option>
                          <option value="InActive">InActive</option>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-sm-4">
                    <div class="form-group">
                      <label for="chapter_description">Chapter Description</label>
                      <input type="text" name="chapter_description" id="chapter_description" class="form-control" placeholder="Enter chapter Description. *">
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                      <input type="hidden" name="chapter_id" id="chapter_id" value="" />
                      <input type="hidden" name="button_action" id="button_action" value="insert" />
                      <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Chapter">
                  </div>
                  <div class="col-sm-4"></div>
                </div>
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
        <table class="table table-striped table-bordered data-table">
          <thead>
            <tr>
              <th style="width:10px !important;text-align:center"></th>
              <th>Sr.No</th>
              <th>Board Name</th>
              <th>Medium Name</th>
              <th>Class Name</th>
              <th>Subject Name</th>
              <th>Chapter No.</th>
              <th>Chapter Name</th>
              <!-- <th>Chapter Description</th> -->
              <!-- <th>Chapter Status</th> -->
              <th>Created Date / Time</th>
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
  //Board List Here
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
                  $('#medium_id').html('<option value="">No Medium</option>');
                }
            }
        });
    });

  //Class List Here//
  $('#medium_id').on('change', function(event){ 
        event.preventDefault();
        var medium_id = this.value;
        $.ajax({
            url: base_url + "/admin/getClass",
            method:"GET",
            data:{medium_id:medium_id},
            success:function(result)
            {
                if(result)
                {
                  $('#class_id').html('<option value="">--Select Class--</option>');
                  $('#class_id').append(result);
                }else{
                  $('#class_id').html('<option value="">No Class</option>');
                }
            }
        });
    });

   //Subject List Here//
  $('#class_id').on('change', function(event){ 
        event.preventDefault();
        var class_id = this.value;
        $.ajax({
            url: base_url + "/admin/getSubject",
            method:"GET",
            data:{class_id:class_id},
            success:function(result)
            {
                if(result)
                {
                  $('#subject_id').html('<option value="">--Select Subject--</option>');
                  $('#subject_id').append(result);
                }else{
                  $('#subject_id').html('<option value="">No Subject</option>');
                }
            }
        });
    });

   //View/Get data in html format Here//
   fetchChapterData();
   function fetchChapterData()
   {
    $.ajax({
     url: base_url + "/admin/getChapterAllData",
     dataType:"json",
     success:function(data)
    {
      var html = '';
    for(var count=0; count < data.length; count++)
      {
        html +='<tr>';
        var createdAtDate = new Date(data[count].created_on);
          var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', {
              year: 'numeric',
              month: 'short',
              day: 'numeric'
          });
        html += '<td><input type="checkbox" class="selectchapterCheckbox" data-chapter-id="' + data[count].chapter_id + '"></td>';
        html +='<td data-column_name="chapter_id" data-id="'+data[count].chapter_id+'">'+data[count].chapter_id+'</td>';
        html +='<td data-column_name="board_id" data-id="'+data[count].chapter_id+'">'+data[count].board_name+'</td>';
        html +='<td data-column_name="medium_id" data-id="'+data[count].chapter_id+'">'+data[count].medium+'</td>';
        html +='<td data-column_name="class_id" data-id="'+data[count].chapter_id+'">'+data[count].class_name+'</td>';
        html +='<td data-column_name="subject_id" data-id="'+data[count].chapter_id+'">'+data[count].subject_name+'</td>';
        html += '<td data-column_name="chapter_no" data-id="'+data[count].chapter_id+'">'+data[count].chapter_no+'</td>';
        html += '<td data-column_name="chapter_name" data-id="'+data[count].chapter_id+'">'+data[count].chapter_name+'</td>';
        html += '<td data-column_name="created_at" data-id="' + data[count].chapter_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
        html += '<td>';
        html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].chapter_id+'" data-subject-id="'+data[count].subject_id+'" data-toggle="modal"  title="Update Class Details"><i class="fas fa-edit"></i></button>';
        html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button"  data-id="'+data[count].chapter_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
        html += '</td></tr>';
    }
      $('tbody').html(html);
      $('.data-table').DataTable({
          // DataTables configuration options here
          "order": [[0, "desc"]], // Example: Sort by the first column (subject_id) in descending order
          "paging": true,
          "pageLength": 10,
          "bDestroy": true
      });
    }
    });
   }
    //Add Subject Using Ajax //
    $('#addChapter').on('submit', function(event){ 
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({ 
            url: base_url + "/admin/addChapter",
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
                        $('#addChapter')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#chapterModal").modal("hide");
                        setInterval('location.reload()', 4000);   
                         //window.location.reload();
                    }
                }
    
        });
    });

    //Update data fetch Here//
  $(document).on('click', '.update', function(){
         var chapter_id = $(this).attr("data-id");
         var subject_id = $(this).attr("data-subject-id");
         var board_id   = $(this).attr("data-board-id");
         var medium_id  = $(this).attr("data-medium-id");
         var class_id   = $(this).attr("data-class-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetChaptertData",
            method:'post',
            data:{_token:_accessToken,chapter_id:chapter_id,subject_id:subject_id,board_id:board_id,medium_id:medium_id,class_id:class_id},
            dataType:'json',
            success:function(data)
            {
              //Medium Data//
              var htmlString = data.medium_id;
              var options = $(htmlString);
                // Iterate over the options
                options.each(function(index, option) {
                  options.filter(':contains("2")').prop('selected', true);
                });
                $('#medium_id').html(options);
              //class Data//
              var htmlclassString = data.class_id;
              var optionsClass = $(htmlclassString);
                // Iterate over the options
                optionsClass.each(function(index, optionclass) {
                  optionsClass.filter(':contains("2")').prop('selected', true);
                });
                $('#class_id').html(optionsClass);
              
                //Subject Data//
              var htmlSubjectString = data.subject_id;
              var optionSubject = $(htmlSubjectString);
                // Iterate over the options
                optionSubject.each(function(index,subject) {
                    optionSubject.filter(':contains("2")').prop('selected', true);
                });
                $('#subject_id').html(optionSubject);

                $('#board_id').val(data.board_id);
                //$('#medium_id').val(data.medium_id);
                $('#chapter_no').val(data.chapter_no);
                $('#chapter_name').val(data.chapter_name);
                // $('#chapter_description').val(data.chapter_description);
                $('#chapter_status').val(data.chapter_status);
                $('#chapter_id').val(chapter_id);
                $('#chapterModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Update Chapter Data');
                $('#button_action').val('update');
            }
         })
   });

  //Delete subject Here//
  var _token = $('input[name="_token"]').val();
  $(document).on('click', '#delete', function(){
        var chapter_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?"))
        {
        $.ajax({
        url: base_url + "/admin/deleteChapterData",
        method:"delete",
        data:{chapter_id:chapter_id, _token:_token},
        success:function(data)
        {
            $('#form_output').html(data);
            fetchChapterData();
        }
        });
        }
    });

    $(document).on('click', '#select_all', function() {
     $(".selectchapterCheckbox").prop("checked", this.checked);
     $("#select_count").html($("input.selectchapterCheckbox:checked").length+" Selected");
   });
   $(document).on('click', '.selectchapterCheckbox', function() {
     if ($('.selectchapterCheckbox:checked').length == $('.selectchapterCheckbox').length) {
       $('#select_all').prop('checked', true);
     } else {
       $('#select_all').prop('checked', false);
     }
        $("#select_count").html($("input.selectchapterCheckbox:checked").length+" Selected");
   });
   
   $('#delete_records').on('click', function(e) {
     var chapter_delete = [];
     $(".selectchapterCheckbox:checked").each(function() {
      chapter_delete.push($(this).attr('data-chapter-id'));
   
     });
     if(chapter_delete.length <=0) {
            alert("Please select records."); 
         }else{
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(chapter_delete.length>1?"these chapter details":"this chapter detail")+" ? \nNote:- After delete you can not access this data.";
            var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {
            var selected_values = chapter_delete.join(",");
            $.ajax({
               url: base_url + "/admin/deleteMultipleChapterData",
               method: 'post',
               data: {_token:_accessToken,chapter_ids:selected_values},
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                  $('#delete_records').prop('disabled', true);
                  $('#form_output').html(response);
                  setInterval('location.reload()', 1000);
                  fetchChapterData();
               }
            });
         }
         }
   });  


  });
</script>
</body>
</html>