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
                    <h5 class="m-b-10">Manage Questions Here</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Manage Questions Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Manage Questions Details</a></li>
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
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#questionModal" > <i class="fa-solid fa-plus"></i> Add New Question </button>
        </div>
        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="questionModalLabel">Create Question</h5>
                        <button id="topicModalClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form autocomplete="off" id="addQuestion" method="post">
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
                                <label for="topic_id" class="col-form-label">Select Topic:</label>
                                <select class="form-control formField" name="topic_id" id="topic_id">
                                    <option value="">--- Select Topic ---</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-6 form-group">
                                <label for="marks" class="col-form-label"> Enter marks:</label>
                                <input type="text" class="form-control formField" id="marks" placeholder="Enter Marks" name="marks">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="questionType_id" class="col-form-label">Select Question Type:</label>
                                <select class="form-control formField" name="questionType_id" id="questionType_id">
                                    <option value="">--- Select Question Type ---</option>
                                    @if(!empty($QuestionTypeList))
                                        @foreach($QuestionTypeList as $data)
                                            <option value="{{ $data->question_type_id }}">{{ $data->question_type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="dificultyLevel" class="col-form-label">Difficult Level:</label>
                                <select class="form-control formField" name="dificultyLevel" id="dificultyLevel">
                                    <option value="">--- Select Difficult Level ---</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Advance">Advance</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="question_status" class="col-form-label"> Question Status:</label>
                                <select class="form-control formField" name="question_status" id="question_status">
                                    <option value="">--Select Status--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group" style="text-align:center;">
                                <button type="button" class="btn btn-primary" name="addQuestionBtn" id="addQuestionBtn">Add Question</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="question_bank_id" id="question_bank_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Question">
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
                            <th>Sr.No</th>
                            <th>Board</th>
                            <th>Medium</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Chapter</th>
                            <th>Marks</th>
                            <th>Type</th>
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
    $('#questionModal').on('hidden.bs.modal', function () {
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

    $('#chapter_id').on('change', function(event){ 
        event.preventDefault();
        var board_id = $("#board_id").val();
        var medium_id = $("#medium_id").val();
        var class_id = $("#class_id").val();
        var subject_id = $("#subject_id").val();
        var chapter_id = this.value;
        $.ajax({
            url: base_url + "/admin/getTopicAjax",
            method:"GET",
            data:{chapter_id:chapter_id},
            success:function(result){
                $('#topic_id').html('<option value="">--- Select Topic ---</option>');
                if(result){
                    $('#topic_id').append(result);
                }
            }
        });
    });

    //View/Get data in html format Here//
    fetchQuestionData();
    function fetchQuestionData()
    {
        $.ajax({
            url: base_url + "/admin/getQuestionAllData",
            dataType:"json",
            success:function(data) {
                var html = '';
                for(var count=0; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_at);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);

                    html +='<td contenteditable class="column_name" data-column_name="question_bank_id" data-id="'+data[count].question_bank_id+'">'+data[count].question_bank_id+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].question_bank_id+'">'+data[count].board_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="medium_name" data-id="'+data[count].question_bank_id+'">'+data[count].medium_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="class_name" data-id="'+data[count].question_bank_id+'">'+data[count].class_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="subject_name" data-id="'+data[count].question_bank_id+'">'+data[count].subject_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="chapter_name" data-id="'+data[count].question_bank_id+'">'+data[count].chapter_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="marks" data-id="'+data[count].question_bank_id+'">'+data[count].marks+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type" data-id="'+data[count].question_bank_id+'">'+data[count].question_type+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].question_bank_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';
                    html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].question_bank_id+'" data-subject-id="'+data[count].subject_id+'" data-topic-id="'+data[count].topic_id+'" data-chapter-id="'+data[count].chapter_id+'" data-questionType="'+data[count].question_type_id+'" data-toggle="modal" title="Update Question Bank Details"><i class="fas fa-edit"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].question_bank_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
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
    $('#addQuestion').on('submit', function(event){ 
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
        } else if($("#marks").val() == ''){
            err = 1;
        } else if($("#questionType_id").val() == ''){
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
                url: base_url + "/admin/addQuestion",
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
                        $('#addQuestion')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#questionModal").modal("hide");
                        setInterval('location.reload()', 1000);   
                        //window.location.reload();
                    }
                }
            });
        }
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
        var question_bank_id = $(this).attr("data-id");
        var board_id   = $(this).attr("data-board-id");
        var medium_id = $(this).attr("data-medium-id");
        var class_id = $(this).attr("data-class-id");
        var subject_id = $(this).attr("data-subject-id");
        var chapter_id = $(this).attr("data-chapter-id");
        var topic_id = $(this).attr("data-topic-id");
        var questionType_id = $(this).attr("data-questionType");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetQuestionData",
            method:'get',
            data:{question_bank_id:question_bank_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id,questionType_id:questionType_id},
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

                //Topic Data//
                var htmlTopicString = data.topic_id;
                var optionTopic = $(htmlTopicString);
                // Iterate over the options
                optionTopic.each(function(index,topic) {
                    optionTopic.filter(':contains("2")').prop('selected', true);
                });
                $('#topic_id').html(optionTopic);

                //Chapter Data//
                var htmlQuestionTypeString = data.question_type;
                var optionQuestionType = $(htmlQuestionTypeString);
                // Iterate over the options
                optionQuestionType.each(function(index,questionType) {
                    optionQuestionType.filter(':contains("2")').prop('selected', true);
                });
                $('#questionType_id').html(optionQuestionType);

                $('#board_id').val(data.board_id);
                $('#dificultyLevel').val(data.level);
                $('#question_status').val(data.question_status);
                $('#marks').val(data.marks);
                $('#question_bank_id').val(question_bank_id);
                $('#questionModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
         })
   });

   //Delete Medium Here//
   var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var question_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?")) {
            $.ajax({
                url: base_url + "/admin/deleteQuestionData",
                method:"delete",
                data:{question_id:question_id, _token:_token},
                success:function(data)
                {
                    $('#form_output').html(data);
                    fetchQuestionData();
                    window.location.reload();
                }
            });
        }
    });
});
</script>
</body>
</html>