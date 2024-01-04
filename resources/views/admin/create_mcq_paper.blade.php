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
                    <h5 class="m-b-10">Create MCQ Paper</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Create MCQ Paper Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Create MCQ Paper Details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ stiped-table ] start -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header"></div>
            <form autocomplete="off" id="addMCQPaper" method="post">
                <div class="card-body">
                    {{ csrf_field() }}
                    <div class="row mcqPaperOtherData">
                        <div class="col-md-3 form-group">
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
                        <div class="col-md-3 form-group">
                            <label for="medium_id" class="col-form-label">Select Medium </label>
                            <select class="form-control formField" name="medium_id" id="medium_id">
                                <option value="">--- Select Medium ---</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="class_id" class="col-form-label">Select Class:</label>
                            <select class="form-control formField" name="class_id" id="class_id">
                                <option value="">--- Select Class ---</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="subject_id" class="col-form-label">Select Subject:</label>
                            <select class="form-control formField" name="subject_id" id="subject_id">
                                <option value="">--- Select Subject ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mcqPaperOtherData">                            
                        <div class="col-md-3 form-group">
                            <label for="marks" class="col-form-label"> Select Date:</label>
                            <input type="text" class="form-control form-control-sm hasDatepicker" id="datepicker" placeholder="Select Date" name="selected_date">
                        </div>
                    </div>
                    <div class="row mcqPaperOtherData">
                        <div class="col-md-6 form-group">
                            <label for="filterchaptername" class="col-form-label">All Chapter:</label>
                            <select class="form-control form-control-sm formField" name="filterchaptername" id="filterchaptername" multiple="" onchange="addToSelectBox2()" style="height:200px"></select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="filterchaptername2" class="col-form-label">Select Chapter:</label>
                            <select class="form-control form-control-sm formField" name="filterchaptername2[]" id="filterchaptername2" multiple="" onchange="removeFromSelectBox2()" style="height:200px"></select>
                        </div>
                    </div>

                    <div id="questionCounter">
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Chapter Name</th>
                                        <th scope="col">Question Counter</th>
                                        <th scope="col">Total Question</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align:center;">
                            <button type="submit" name="submit" id="submitMCQPaper" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    <div style="text-align:center;">
                        <input type="hidden" name="selectedChapters" id="selectedChapters" value="" />
                        <input type="hidden" name="allChapters" id="allChapters" value="" />
                        <input type="hidden" name="mcq_question_paper_id" id="mcq_question_paper_id" value="" />
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <button type="button" name="submit" id="actionDataProcess" class="btn btn-primary">Data Process</button>
                    </div>
                </div>
            </form>
        </div>
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
<script src="{{ asset('public/assets/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{ asset('public/assets/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('public/assets/js/summernote-math.js')}}"></script>
<script>
$(document).ready(function() {
    $(".mcqPaperOtherData").show();
    $("#questionCounter").hide();
    $("#actionDataProcess").show();

    var today = new Date();
    $("#datepicker").datepicker({
        minDate: today,
        dateFormat: 'yy-mm-dd'
    });
    // Set the initial date to today
    $("#datepicker").datepicker("setDate", today);

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
            url: base_url + "/admin/getAllChaptersAjax",
            method:"GET",
            data:{subject_id:subject_id},
            success:function(result){
                $("#allChapters").val(1);
                $("#filterchaptername").css('border','1px solid #00000032');
                $("#filterchaptername").html(result);
            }
        });
    });

    $("#board_id, #medium_id, #class_id, #subject_id").on('change', function(){
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });

    $("#actionDataProcess").on("click", function(){
        // mcqPaperOtherData
        // questionCounter
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
        } else if($("#allChapters").val() == ''){
            err = 1;
            fieldId = $("#filterchaptername");
        } else if($("#selectedChapters").val() == ''){
            err = 1;
            fieldId = $("#filterchaptername2");
        }

        if (err == 1){
            $('.formField').filter(function() {
                return this.value == ''
            }).css('border','1px solid #e60000'); //#495057
            return false;
        } else {
            var values = $.map( $('#filterchaptername2 option') ,function(option) {
                return option.value;
            });
            $('#filterchaptername2').val(values);
            $.ajax({
                url: base_url + "/admin/getSelectedChapterDetailsAjax",
                method:"POST",
                data:{_token:_accessToken,filterchapternames:$('#filterchaptername2').val()},
                success:function(result){
                    $(".mcqPaperOtherData").hide();
                    $("#questionCounter").show();
                    $("#questionCounter tbody").html(result);
                    $("#actionDataProcess").hide();
                }
            });
        }
    });

    //Add Medium Using Ajax //
    $('#addMCQPaper').on('submit', function(event){ 
        event.preventDefault();
        var err = 0;
        var fieldId = '';

        if (err == 1){
            $('.formField').filter(function() {
                return this.value == ''
            }).css('border','1px solid #e60000'); //#495057
            return false;
        } else {
            var values = $.map( $('#filterchaptername2 option') ,function(option) {
                return option.value;
            });
            $('#filterchaptername2').val(values);
            var form_data = $(this).serialize();
            $.ajax({ 
                url: base_url + "/admin/addmcqpaper",
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
                        $('#addMCQPaper')[0].reset(); 
                        window.location.href = data.redirect_url;
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
        var question_type_id = $(this).attr("data-question-type-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetQuestionData",
            method:'get',
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

function addToSelectBox2() {
    var selectBox1 = document.getElementById('filterchaptername');
    var selectBox2 = document.getElementById('filterchaptername2');
    var selectedOptions = Array.from(selectBox1.selectedOptions);
    if (selectedOptions.length > 0) {
        $("#filterchaptername,#filterchaptername2").css('border','1px solid #00000032');
        document.getElementById("allChapters").value = 1;
        document.getElementById("selectedChapters").value = 1;
    }
    for (var i = 0; i < selectedOptions.length; i++) {
        var option = selectedOptions[i];
        selectBox2.appendChild(option.cloneNode(true));
        selectBox1.remove(option.index);
    }
}

function removeFromSelectBox2() {
    var selectBox1 = document.getElementById('filterchaptername');
    var selectBox2 = document.getElementById('filterchaptername2');
    var selectedOptions = Array.from(selectBox2.selectedOptions);
    if (selectedOptions.length == 0) {
        document.getElementById("allChapters").value = '';
        document.getElementById("selectedChapters").value = '';
    }
    for (var i = 0; i < selectedOptions.length; i++) {
        var option = selectedOptions[i];
        selectBox1.appendChild(option.cloneNode(true));
        selectBox2.remove(option.index);
    }
}
</script>
</body>
</html>