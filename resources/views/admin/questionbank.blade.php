<!-- Main Header -->
@include('admin.layouts.header')
  <!-- Sidebar -->
@include('admin.layouts.sidebar')
<!-- [ Main Content ] start -->
<!-- <link rel="stylesheet" href="{{ asset('public/assets/css/summernote-bs4.css')}}"> -->
<link href="{{ asset('public/assets/summernote/summernote-bs4.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/assets/summernote/summernote.css')}}" rel="stylesheet">
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
                                <label for="question_type_id" class="col-form-label">Select Question Type:</label>
                                <select class="form-control formField" name="question_type_id" id="question_type_id">
                                    <option value="">--- Select Question Type ---</option>
                                    @if(!empty($QuestionTypeList))
                                        @foreach($QuestionTypeList as $data)
                                            <option value="{{ $data->qType }}">{{ $data->qType }}</option>
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

                        <!-- MCQ section -->
                        <div class="row" id="mcqForm" style="display:none">
                            <div class="col-md-8 form-group">
                                <label for="mcqQuestion">Question (MCQs)</label>
                                <textarea class="textarea formField" name="mcqQuestion" id="mcqQuestion" placeholder="Place some text here" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="question">Options</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="qOption" value="option1"></span>
                                    </div>
                                    <input type="text" class="form-control" name="option1" id="option1">
                                </div>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="qOption" value="option2"></span>
                                    </div>
                                    <input type="text" class="form-control" name="option2" id="option2">
                                </div>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="qOption" value="option3"></span>
                                    </div>
                                    <input type="text" class="form-control" name="option3" id="option3">
                                </div>
                                <div class="input-group mt-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="qOption" value="option4"></span>
                                    </div>
                                    <input type="text" class="form-control" name="option4" id="option4">
                                </div>
                            </div>
                        </div>
                        <!-- MCQ section ends -->

                        <!-- True False Section -->
                        <div class="row" id="trueFalseFrom" style="display:none">
                            <div class="col-md-8 form-group">
                                <label for="tfQuestion">Question (True / False)</label>
                                <textarea class="textarea formField" name="tfQuestion" id="tfQuestion" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="col-sm-4">
                                <label for="question">Options</label>
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group">                              
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><input type="radio" name="trueFalse" value="Yes"></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="true" value="True" readonly>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">                              
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><input type="radio" name="trueFalse" value="No"></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="false" value="False" readonly>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- True False Section End-->

                        <!-- Written Question  -->
                        <div class="row" id="writtenQuestions" style="display:none">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Question <span id="qt"></span></label>
                                    <textarea class="textarea formField question-editor" name="question" id="question" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="solution">Solution</label>
                                    <textarea class="textarea formField solution-editor" name="solution" id="solution" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Written Question End -->

                        <div class="modal-footer">
                            <input type="hidden" name="question_bank_id" id="question_bank_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" id="action" class="btn  btn-primary" value="Add Question">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-border-style">
        <div class="table-responsive">
            <span id="form_output"></span>
            <table class="table table-striped table-bordered example1" id="example1">
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
                        <th>Question</th>
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
<style>
    .empty-border {
      border: 1px solid red; /* Customize the border style */
    }
    .filled-border {
      border: 2px solid rgba(0, 0, 0, 0.15); /* Customize the border style */
    }
</style>
<script src="{{ asset('public/assets/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('public/assets/js/summernote-math.js')}}"></script>
<script>
$(document).ready(function() {
    //  $(".example1").DataTable({
    //   "responsive": true,
    //   "autoWidth": false,
    //   "pageLength": 50,
    //   "language": {
    //   "lengthMenu": 'Show <select class="form-control form-control-sm">'+
    //   '<option value="10">10</option>'+
    //   '<option value="50">50</option>'+
    //   '<option value="100">100</option>'+
    //   '<option value="500">500</option>'+
    //   '<option value="1000">1000</option>'+
    //   '<option value="-1">All</option>'+
    //   '</select> entries'
    //  }
    // });

    $('.textarea').summernote({
        fontSizes: ['8', '9', '10', '11', '12', '13', '14','16', '18','20', '24'],
        height: 150,
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear','strikethrough','superscript', 'subscript','fontsize','fontsizeunit','fontname','color','forecolor','backcolor']],
            ['para', ['ul', 'ol', 'paragraph', 'style','height']],
            ['insert', ['picture','hr','link','video','table','math']],
            ['misc', ['undo', 'redo']],
            ['view', ['fullscreen', 'codeview','help']],
        ]
    });

    $('#questionModal').on('hidden.bs.modal', function () {
        $('.formField').filter(function() {
            return this.value == ''
        }).css('border','2px solid rgba(0, 0, 0, 0.15)');
        $(this).find('form').trigger('reset');
    });

    $('#board_id').on('change', function(event){ 
        event.preventDefault();
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
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
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
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
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
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
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
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
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
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

    $("#topic_id, #dificultyLevel, #question_status").on('change', function(){
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });
    $("#marks").on('keyup', function(){
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });

    $("#question_type_id").on('change', function(event){
        var questionType = $(this).val();
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
        if (questionType=="") {
            $("#mcqForm, #trueFalseFrom, #writtenQuestions").hide();
        } else if (questionType=="MCQ") {
            $("#mcqFrom").show();
            $("#trueFalseFrom, #writtenQuestions").hide();
        } else if (questionType=="True or False") {
            $("#mcqFrom").hide();
            $("#trueFalseFrom").show();
            $("#writtenQuestions").hide();
        } else{
            $("#mcqFrom, #trueFalseFrom").hide();
            $("#qt").html("("+questionType+")");
            $("#writtenQuestions").show();
        }
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
                for(var count=1; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_on);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);

                    html +='<td contenteditable class="column_name" data-column_name="question_id" data-id="'+data[count].question_id+'">'+count+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].question_id+'">'+data[count].board_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="medium_name" data-id="'+data[count].question_id+'">'+data[count].medium+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="class_name" data-id="'+data[count].question_id+'">'+data[count].class_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="subject_name" data-id="'+data[count].question_id+'">'+data[count].subject_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="chapter_name" data-id="'+data[count].question_id+'">'+data[count].chapter_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="marks" data-id="'+data[count].question_id+'">'+data[count].marks+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type" data-id="'+data[count].question_id+'">'+data[count].question_type+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type" data-id="'+data[count].question_id+'">'+data[count].question+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].question_id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';
                    html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].question_bank_id+'" data-subject-id="'+data[count].subject_id+'" data-topic-id="'+data[count].topic_id+'" data-chapter-id="'+data[count].chapter_id+'" data-questionType="'+data[count].question_type_id+'" data-toggle="modal" title="Update Question Bank Details"><i class="fas fa-edit"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].question_id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
                    html += '</td></tr>';
                }
                $('tbody').html(html);
                $('#example1').DataTable({
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
        var fieldId = '';
        if($("#board_id").val() == ''){
            err = 1;
            fieldId = $("#board_id");
        } else if($("#medium_id").val() == ''){
            err = 1;
            fieldId = $("#medium_id");
        } else if($("#class_id").val() == ''){
            err = 1;
            fieldId = $("#class_id");
        } else if($("#subject_id").val() == ''){
            err = 1;
            fieldId = $("#subject_id");
        } else if($("#chapter_id").val() == ''){
            err = 1;
            fieldId = $("#chapter_id");
        } else if($("#topic_id").val() == ''){
            err = 1;
            fieldId = $("#topic_id");
        } else if($("#marks").val() == ''){
            err = 1;
            fieldId = $("#marks");
        } else if($("#question_type_id").val() == ''){
            err = 1;
            fieldId = $("#question_type_id");
        } else if($("#question_type_id").val() == 'MCQ'){
            if ($.trim($("textarea#mcqQuestion").val())=="") {
                $("textarea#mcqQuestion").focus();
                err = 1;
            }else if (!$("input[name='qOption']:checked").val()) {
                err = 1;
            }
        } else if($("#question_type_id").val() == 'True or False'){
            if ($.trim($("textarea#tfQuestion").val())=="") {
                $("textarea#tfQuestion").focus();
                err = 1;
            }else if (!$("input[name='trueFalse']:checked").val()) {
                err = 1;
            }
        } else if($("#question_type_id").val() != 'MCQ' || $("#question_type_id").val() != 'True or False'){
            if ($.trim($("textarea#question").val())=="") {
                $('#writtenQuestions #question').summernote('focus');
                $(".question-editor").parent().find('.note-editor').css('border','1px solid #e60000');
                return false;
            }else if ($.trim($("textarea#solution").val())=="") {
                $('#writtenQuestions #solution').summernote('focus');
                $(".solution-editor").parent().find('.note-editor').css('border','1px solid #e60000');
                return false;
            }
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

    $('.question-editor').on('summernote.change', function() {
        // Remove the border if content is not empty
        if ($.trim($("textarea#question").val())!="") {
            $(".question-editor").parent().find('.note-editor').css('border','1px solid #00000032');
        }
    });

    $('.solution-editor').on('summernote.change', function() {
        // Remove the border if content is not empty
        if ($.trim($("textarea#solution").val())!="") {
            $(".solution-editor").parent().find('.note-editor').css('border','1px solid #00000032');
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
        var question_type_id = $(this).attr("data-questionType");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetQuestionData",
            method:'post',
            data:{question_bank_id:question_bank_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id,question_type_id:question_type_id},
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
                $('#question_type_id').html(optionQuestionType);

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