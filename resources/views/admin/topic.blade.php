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
                    <h5 class="m-b-10">Topic Here (Total : <?php echo $topic_count;?>)</h5>
                </div>
                <!-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Topic Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Topic Details</a></li>
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
            <label><input type="checkbox" id="select_all" class="mt-2" style="cursor:pointer;"> Select All  </label>
            <button type="button" id="delete_records" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete <span class="rows_selected" id="select_count">0 Selected</span></button>
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#topicModal" > <i class="fa-solid fa-plus"></i> Add New Topic </button>
        </div>
        <div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="topicModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="topicModalLabel">Create Topic</h5>
                        <button id="topicModalClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form autocomplete="off" id="addTopic" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-6 form-group">
                        <label for="recipient-name" class="col-form-label">Select Board </label>
                            <select class="form-control formField" name="board_id" id="board_id">
                                <option value="">--- Select Board ---</option>
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
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="class_id" class="col-form-label">Select Class:</label>
                                <select class="form-control formField" name="class_id" id="class_id">
                                    <option value="">--- Select Class ---</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="subject_id" class="col-form-label">Select Subject:</label>
                                <select class="form-control formField" name="subject_id" id="subject_id">
                                    <option value="">--- Select Subject ---</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="chapter_id" class="col-form-label">Select Chapter:</label>
                                <select class="form-control formField" name="chapter_id" id="chapter_id">
                                    <option value="">--- Select Chapter ---</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="topic_name" class="col-form-label"> Topic name:</label>
                                <input type="text" class="form-control formField" id="topic_name" placeholder="Topic name" name="topic_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="topic_status" class="col-form-label"> Topic Status:</label>
                                <select class="form-control formField" name="topic_status" id="topic_status">
                                    <option value="">--Select Status--</option>
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="topic_id" id="topic_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Topic">
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
                            <th>Board</th>
                            <th>Medium</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Chapter</th>
                            <th>Topic</th>
                            <th>Topic status</th>
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
    $('#topicModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    });

    $('#board_id').on('change', function(event){ 
        event.preventDefault();
        var board_id = this.value;
        $.ajax({
            url: base_url + "/admin/getTopicMediums",
            method:"GET",
            data:{board_id:board_id},
            success:function(result){
                $('#medium_id').html('<option value="">--- Select Medium ---</option>');
                if(result){
                    $('#medium_id').append(result);
                }
            }
        });
    });

    $('#medium_id').on('change', function(event){ 
        event.preventDefault();
        var medium_id = this.value;
        $.ajax({
            url: base_url + "/admin/getClass",
            method:"GET",
            data:{medium_id:medium_id},
            success:function(result){
                $('#class_id').html('<option value="">--- Select Class ---</option>');
                if(result){
                    $('#class_id').append(result);
                }
            }
        });
    });

    $('#class_id').on('change', function(event){ 
        event.preventDefault();
        var board_id = $("#board_id").val();
        var medium_id = $("#medium_id").val();
        var class_id = this.value;
        $.ajax({
            url: base_url + "/admin/getSubjectsAjax",
            method:"GET",
            data:{class_id:class_id},
            success:function(result){
                $('#subject_id').html('<option value="">--- Select Subject ---</option>');
                if(result){
                    $('#subject_id').append(result);
                }
            }
        });
    });

    $('#subject_id').on('change', function(event){ 
        event.preventDefault();
        var board_id = $("#board_id").val();
        var medium_id = $("#medium_id").val();
        var class_id = $("#class_id").val();
        var subject_id = this.value;
        $.ajax({
            url: base_url + "/admin/getChapterAjax",
            method:"GET",
            data:{subject_id:subject_id},
            success:function(result){
                $('#chapter_id').html('<option value="">--- Select Chapter ---</option>');
                if(result){
                    $('#chapter_id').append(result);
                }
            }
        });
    });
    //View/Get data in html format Here//
    fetchTopicData();
    function fetchTopicData()
    {
        /* var binfo = true;
        var paging = true;
        var table = $('.data-table').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url:  base_url + "/admin/getTopicAllData",
                data: function (d) {
                    d.search = $('input[type="search"]').val()
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
                { data: 'topic_id', name: 'topics.topic_id'},
                { data: 'board_name', name: 'boards.board_name', className: 'text-center' },
                { data: 'medium_name', name: 'mediums.medium_name', className: 'text-center' },
                { data: 'class_name', name: 'class.class_name', className: 'text-center' },
                { data: 'subject_name', name: 'subjects.subject_name',className: "text-center"},
                { data: 'chapter_name', name: 'chapters.chapter_name',className: "text-center"},
                { data: 'topic_name', name: 'topic_name',className: "text-center"},
                { data: 'created_at', name: 'created_at',className: "text-center"},
                { data: 'built_action_btns', name: 'built_action_btns',className: 'text-center'}
            ],
            "order": [[ 6, "desc" ]],
            fixedHeader: {
                header: true
            }
        });

        oTable = $('.data-table').DataTable();
        $('input[type="search"]').keyup(function(){
            oTable.search($(this).val()).draw() ;
        })

        $.fn.dataTable.ext.errMode = 'none';

        $('.data-table').on( 'error.dt', function ( e, settings, techNote, message ) {
            console.log( 'An error has been reported by DataTables: ', message );
        }) ; */

        $.ajax({
            url: base_url + "/admin/getTopicAllData",
            dataType:"json",
            success:function(data) {
                var html = '';
                for(var count=0; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_on);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);
                    html += '<td><input type="checkbox" class="selectTopicCheckbox" data-topic-id="' + data[count].topic_id + '"></td>';
                    html +='<td data-column_name="topic_id" data-id="'+data[count].topic_id+'">'+data[count].topic_id+'</td>';
                    html +='<td data-column_name="board_name" data-id="'+data[count].topic_id+'">'+data[count].board_name+'</td>';
                    html +='<td data-column_name="medium_name" data-id="'+data[count].topic_id+'">'+data[count].medium+'</td>';
                    html +='<td data-column_name="class_name" data-id="'+data[count].topic_id+'">'+data[count].class_name+'</td>';
                    html +='<td data-column_name="subject_name" data-id="'+data[count].topic_id+'">'+data[count].subject_name+'</td>';
                    html +='<td data-column_name="chapter_name" data-id="'+data[count].topic_id+'">'+data[count].chapter_name+'</td>';
                    html +='<td data-column_name="topic_name" data-id="'+data[count].topic_id+'">'+data[count].topic_name+'</td>';
                    html += '<td data-column_name="topic_status" data-id="'+data[count].topic_id+'">'+data[count].topic_status+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].topic_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';
                    html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].topic_id+'" data-subject-id="'+data[count].subject_id+'" data-chapter-id="'+data[count].chapter_id+'" data-toggle="modal"  title="Update Question Type Details"><i class="fas fa-edit"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].topic_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
                    html += '</td></tr>';
                }
                $('tbody').html(html);
                $('#topic_table').DataTable({
                    // DataTables configuration options here
                    "order": [[0, "desc"]], // Example: Sort by the first column (subject_id) in descending order
                    "paging": true,
                    "pageLength": 10,
                    "bDestroy": true
                });
            }
        });
    }

    //Add Medium Using Ajax //
    $('#addTopic').on('submit', function(event){ 
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
        } else if($("#topic_name").val() == ''){
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
                url: base_url + "/admin/addTopic",
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
                        $('#addTopic')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#topicModal").modal("hide");
                        setInterval('location.reload()', 1000);   
                        //window.location.reload();
                    }
                }
            });
        }
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
        var topic_id   = $(this).attr("data-id");
        var board_id   = $(this).attr("data-board-id");
        var medium_id  = $(this).attr("data-medium-id");
        var class_id   = $(this).attr("data-class-id");
        var subject_id = $(this).attr("data-subject-id");
        var chapter_id = $(this).attr("data-chapter-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetTopicData",
            method:'post',
            data:{_token:_accessToken,topic_id:topic_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id},
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

                //Chapter Data//
                var htmlChapterString = data.chapter_id;
                var optionChapter = $(htmlChapterString);
                // Iterate over the options
                optionChapter.each(function(index,chapter) {
                    optionChapter.filter(':contains("2")').prop('selected', true);
                });
                $('#chapter_id').html(optionChapter);

                $('#board_id').val(data.board_id);
                $('#topic_name').val(data.topic_name);
                $('#topic_description').val(data.topic_description);
                $('#topic_status').val(data.topic_status);
                $('#topic_id').val(topic_id);
                $('#topicModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
         })
   });

   //Delete Medium Here//
   var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var topic_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?")) {
            $.ajax({
                url: base_url + "/admin/deleteTopicData",
                method:"delete",
                data:{topic_id:topic_id, _token:_token},
                success:function(data)
                {
                    $('#form_output').html(data);
                    fetchTopicData();
                    window.location.reload();
                }
            });
        }
    });

    ///Multiple Delete
    $(document).on('click', '#select_all', function() {
     $(".selectTopicCheckbox").prop("checked", this.checked);
     $("#select_count").html($("input.selectTopicCheckbox:checked").length+" Selected");
   });
   $(document).on('click', '.selectTopicCheckbox', function() {
     if ($('.selectTopicCheckbox:checked').length == $('.selectTopicCheckbox').length) {
       $('#select_all').prop('checked', true);
     } else {
       $('#select_all').prop('checked', false);
     }
        $("#select_count").html($("input.selectTopicCheckbox:checked").length+" Selected");
   });
   
   $('#delete_records').on('click', function(e) {
     var topic_delete = [];
     $(".selectTopicCheckbox:checked").each(function() {
        topic_delete.push($(this).attr('data-topic-id'));
   
     });
     if(topic_delete.length <=0) {
            alert("Please select records."); 
         }else{
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(topic_delete.length>1?"these class details":"this Class detail")+" ? \nNote:- After delete you can not access this data.";
            var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {
            var selected_values = topic_delete.join(",");
            $.ajax({
               url: base_url + "/admin/deleteMultipleTopicData",
               method: 'post',
               data: {_token:_accessToken,topic_ids:selected_values},
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                  $('#delete_records').prop('disabled', true);
                  $('#form_output').html(response);
                  setInterval('location.reload()', 1000);
                  fetchTopicData();
               }
            });
         }
         }
   });  
});
</script>
</body>
</html>