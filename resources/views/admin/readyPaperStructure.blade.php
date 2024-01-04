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
                    <h5 class="m-b-10">Ready Paper Structure Here</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Ready Paper Structure Info</a></li>
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
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#paperStructureModal" > <i class="fa-solid fa-plus"></i> Add New Structure </button>
        </div>
        <div class="modal fade" id="paperStructureModal" tabindex="-1" role="dialog" aria-labelledby="paperStructureModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paperStructureModalLabel">Create Paper Structure</h5>
                        <button id="paperStructureClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" id="addPaperStructure" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4 form-group">
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
                                <div class="col-md-4 form-group">
                                    <label for="medium_id" class="col-form-label">Select Medium </label>
                                    <select class="form-control formField" name="medium_id" id="medium_id">
                                        <option value="">--- Select Medium ---</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="class_id" class="col-form-label">Select Class:</label>
                                    <select class="form-control formField" name="class_id" id="class_id">
                                        <option value="">--- Select Class ---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="subject_id" class="col-form-label">Select Subject:</label>
                                    <select class="form-control formField" name="subject_id" id="subject_id">
                                        <option value="">--- Select Subject ---</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="total_paper_marks" class="col-form-label">Total Paper Marks:</label>
                                    <select class="form-control formField" name="total_paper_marks" id="total_paper_marks">
                                        <option value="">--Select Total Paper Marks--</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="qType_id" class="col-form-label">Select Question Type:</label>
                                    <select class="form-control formField" name="qType_id" id="qType_id">
                                        <option value="">--- Select Question Type ---</option>
                                        @if(!empty($QuestionTypeList))
                                            @foreach($QuestionTypeList as $data)
                                                <option data-value="{{ $data->qType }}" value="{{ $data->qType }}">{{ $data->qType }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-4 form-group">
                                    <label for="total_marks_as_per_question_type" class="col-form-label">Total Marks As Per Question Type:</label>
                                    <input type="text" class="form-control formField" id="total_marks_as_per_question_type" placeholder="Enter Marks" name="total_marks_as_per_question_type">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="marks_per_each_question" class="col-form-label">Marks Per Each Question:</label>
                                    <input type="text" class="form-control formField" id="marks_per_each_question" placeholder="Enter Marks" name="marks_per_each_question">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="total_no_of_questions_to_ask" class="col-form-label">Total No. Of Questions To Ask:</label>
                                    <input type="text" class="form-control formField" id="total_no_of_questions_to_ask" placeholder="Enter number" name="total_no_of_questions_to_ask">
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-4 form-group">
                                    <label for="total_no_of_questions_to_ans" class="col-form-label">Total No. Of Questions To Answer:</label>
                                    <input type="text" class="form-control formField" id="total_no_of_questions_to_ans" placeholder="Enter Number" name="total_no_of_questions_to_ans">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="question_type_order" class="col-form-label">Question Type Order in Paper:</label>
                                    <input type="text" class="form-control formField" id="question_type_order" placeholder="Enter Order" name="question_type_order">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="sections" class="col-form-label">Sections:</label>
                                    <input type="text" class="form-control" id="sections" placeholder="Enter sections" name="sections">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="sections_name" class="col-form-label">Sections Name:</label>
                                    <input type="text" class="form-control" id="sections_name" placeholder="Sections Heading here" name="sections_name">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="sub_question_type_order" class="col-form-label">Sub Question Order in Paper:</label>
                                    <input type="text" class="form-control" id="sub_question_type_order" placeholder="Sub Question Order" name="sub_question_type_order">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="child_sub_question_type_order" class="col-form-label">Child Sub Question Order in Paper:</label>
                                    <input type="text" class="form-control" id="child_sub_question_type_order" placeholder="Child Sub Question Order" name="child_sub_question_type_order">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="ready_paper_id" id="ready_paper_id" value="" />
                                <input type="hidden" name="button_action" id="button_action" value="insert" />
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" id="createPaperStructureBtn" class="btn btn-primary" value="Create Structure">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="paperStructureViewModal" tabindex="-1" role="dialog" aria-labelledby="paperStructureViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paperStructureViewModalLabel">View Paper Structure</h5>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" id="addPaperStructure" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="view_board_name" class="col-form-label">Board:</label>
                                    <span id="view_board_name"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_medium_name" class="col-form-label">Medium:</label>
                                    <span id="view_medium_name"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_class_name" class="col-form-label">Class:</label>
                                    <span id="view_class_name"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="view_subject_name" class="col-form-label">Subject:</label>
                                    <span id="view_subject_name"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_total_paper_marks" class="col-form-label">Total Paper Marks:</label>
                                    <span id="view_total_paper_marks"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_question_type" class="col-form-label">Question Type:</label>
                                    <span id="view_question_type"></span>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-4 form-group">
                                    <label for="view_total_marks_as_per_question_type" class="col-form-label">Total Marks As Per Question Type:</label>
                                    <span id="view_total_marks_as_per_question_type"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_marks_per_each_question" class="col-form-label">Marks Per Each Question:</label>
                                    <span id="view_marks_per_each_question"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_total_no_of_questions_to_ask" class="col-form-label">Total No. Of Questions To Ask:</label>
                                    <span id="view_total_no_of_questions_to_ask"></span>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-4 form-group">
                                    <label for="view_total_no_of_questions_to_ans" class="col-form-label">Total No. Of Questions To Answer:</label>
                                    <span id="view_total_no_of_questions_to_ans"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_question_type_order" class="col-form-label">Question Type Order in Paper:</label>
                                    <span id="view_question_type_order"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_sections" class="col-form-label">Sections:</label>
                                    <span id="view_sections"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="view_sections_name" class="col-form-label">Sections Name:</label>
                                    <span id="view_sections_name"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_sub_question_type_order" class="col-form-label">Sub Question Order in Paper:</label>
                                    <span id="view_sub_question_type_order"></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="view_child_sub_question_type_order" class="col-form-label">Child Sub Question Order in Paper:</label>
                                    <span id="view_child_sub_question_type_order"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
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
                        <th>Question Type</th>
                        <th>Total marks</th>
                        <th>Marks per question</th>
                        <th>Question order type</th>
                        <th>Create Date / Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
	    </div>
        <!-- Delete Class Modal -->
        <div class="modal fade" id="deleteRPSModal" tabindex="-1" role="dialog" aria-labelledby="deleteRPSModalLabel" aria-hidden="true">
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
    $('#total_marks_as_per_question_type,#marks_per_each_question,#total_no_of_questions_to_ask,#total_no_of_questions_to_ans').keypress(function(event) {
        // Check if the pressed key is a number or not
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          // Prevent the input if it's not a number
          event.preventDefault();
        }
    });

    $('#paperStructureModal').on('hidden.bs.modal', function () {
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
                if(result){
                    $('#medium_id').html('<option value="">--- Select Medium ---</option>');
                    $('#medium_id').append(result);
                }else{
                    $('#medium_id').html('<option value="">--- No Medium ---</option>');
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
                if(result){
                    $('#class_id').append(result);
                }
                if(result){
                    $('#class_id').html('<option value="">--- Select Class ---</option>');      
                    $('#class_id').append(result);
                }else{
                    $('#class_id').html('<option value="">--- No Class ---</option>');
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
                if(result){
                    $('#subject_id').html('<option value="">--- Select Subject ---</option>');      
                    $('#subject_id').append(result);
                }else{
                    $('#subject_id').html('<option value="">--- No Subject ---</option>');
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
                if(result)
                {
                    $('#chapter_id').html('<option value="">--- Select Chapter ---</option>');           
                    $('#chapter_id').append(result);
                }else{
                    $('#chapter_id').html('<option value="">--- No Class ---</option>');
                }
            }
            });
    });

    $('#total_paper_marks').on('change', function(event){ 
        event.preventDefault();
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });

    $("#total_marks_as_per_question_type,#marks_per_each_question,#total_no_of_questions_to_ask,#total_no_of_questions_to_ans,#question_type_order").on('keyup', function(){
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });

    $(document).on('change',"#question_type_id", function(event){
        var questionType = $(this).val();
        $(this).css('border','2px solid rgba(0, 0, 0, 0.15)');
    });

    //View/Get data in html format Here//
    fetchReadyPaperData();
    function fetchReadyPaperData()
    {
        $.ajax({
            url: base_url + "/admin/getReadyQuestionPaperData",
            dataType:"json",
            success:function(data) {
                var html = '';
                
                for(var count=0; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_at);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);
                    html +='<td contenteditable class="column_name" data-column_name="id" data-id="'+data[count].id+'">'+(parseInt(count+1))+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].id+'">'+data[count].board_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="medium" data-id="'+data[count].id+'">'+data[count].medium+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="class_name" data-id="'+data[count].id+'">'+data[count].class_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="subject_name" data-id="'+data[count].id+'">'+data[count].subject_name+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type_id" data-id="'+data[count].id+'">'+data[count].question_type_id+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="total_paper_marks" data-id="'+data[count].id+'">'+data[count].total_paper_marks+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="marks_per_each_question" data-id="'+data[count].id+'">'+data[count].marks_per_each_question+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="question_type_order" data-id="'+data[count].id+'">'+data[count].question_type_order+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';
                    html += '<button class="btn btn-sm btn-secondary mt-1 view" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].id+'" data-subject-id="'+data[count].subject_id+'" data-total-marks="'+data[count].total_paper_marks+'" data-question-type-id="'+data[count].question_type_id+'" data-toggle="modal" title="Update Ready Paper Structure Details"><i class="fas fa-eye"></i></button>';
                    html += '<button class="btn btn-sm btn-warning mt-1 ml-2 update" type="button" data-class-id ="'+data[count].class_id+'" data-medium-id ="'+data[count].medium_id+'" data-board-id ="'+data[count].board_id+'" data-id="'+data[count].id+'" data-subject-id="'+data[count].subject_id+'" data-total-marks="'+data[count].total_paper_marks+'" data-question-type-id="'+data[count].question_type_id+'" data-toggle="modal" title="Update Ready Paper Structure Details"><i class="fas fa-edit"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].id+'" data-toggle="modal"  title="Delete Ready Paper Structure Details"><i class="fas fa-trash-alt"></i></button>';
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
    $('#addPaperStructure').on('submit', function(event){ 
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
        } else if($("#total_paper_marks").val() == ''){
            err = 1;
            fieldId = $("#total_paper_marks");
        } else if($("#question_type_id").val() == ''){
            err = 1;
            fieldId = $("#question_type_id");
        } else if($("#total_marks_as_per_question_type").val() == ''){
            err = 1;
            fieldId = $("#total_marks_as_per_question_type");
        } else if($("#marks_per_each_question").val() == ''){
            err = 1;
            fieldId = $("#marks_per_each_question");
        } else if($("#total_no_of_questions_to_ask").val() == ''){
            err = 1;
            fieldId = $("#total_no_of_questions_to_ask");
        } else if($("#total_no_of_questions_to_ans").val() == ''){
            err = 1;
            fieldId = $("#total_no_of_questions_to_ans");
        } else if($("#question_type_order").val() == ''){
            err = 1;
            fieldId = $("#question_type_order");
        }

        if (err == 1){
            $('.formField').filter(function() {
                return this.value == ''
            }).css('border','1px solid #e60000'); //#495057
            return false;
        } else {
            var form_data = $(this).serialize();
            $.ajax({ 
                url: base_url + "/admin/addPaperStructureDetails",
                method:"POST",
                data:form_data,
                dataType:"json",
                beforeSend:function(){
                    $('#createPaperStructureBtn').append('&emsp;<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $('#createPaperStructureBtn').prop('disabled', true);
                },
                success:function(data){
                    if(data.error.length > 0) {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++) {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    } else {
                        $('#form_output').html(data.success);
                        $('#addPaperStructure')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#paperStructureModal").modal("hide");
                        setInterval('location.reload()', 1000);
                    }
                }
            });
        }
    });

    //Update data fetch Here//
    $(document).on('click', '.update', function(){
        var ready_paper_id = $(this).attr("data-id");
        var board_id   = $(this).attr("data-board-id");
        var medium_id = $(this).attr("data-medium-id");
        var class_id = $(this).attr("data-class-id");
        var subject_id = $(this).attr("data-subject-id");
        var chapter_id = $(this).attr("data-chapter-id");
        var topic_id = $(this).attr("data-topic-id");
        var total_marks = $(this).attr("data-total-marks");
        var question_type_id = $(this).attr("data-question-type-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetReadyPaperStructureData",
            method:'get',
            data:{ready_paper_id:ready_paper_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,question_type_id:question_type_id,total_marks:total_marks},
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

                //Question Type Data//
                var htmlQuestionTypeString = data.question_type;
                var optionQuestionType = $(htmlQuestionTypeString);
                // Iterate over the options
                optionQuestionType.each(function(index,questionType) {
                    optionQuestionType.filter(':contains("2")').prop('selected', true);
                });
                $('#qType_id').html(optionQuestionType);

                //Total Marks Data//
                var htmlTotalMarksString = data.total_paper_marks;
                var optionTotalMarks = $(htmlTotalMarksString);
                // Iterate over the options
                optionTotalMarks.each(function(index,TotalMarks) {
                    optionTotalMarks.filter(':contains("2")').prop('selected', true);
                });
                $('#total_paper_marks').html(optionTotalMarks);

                $('#board_id').val(data.board_id);
                $('#ready_paper_id').val(ready_paper_id);
                $('#paperStructureModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
                $("#total_marks_as_per_question_type").val(data.total_marks_as_per_question_type);
                $("#marks_per_each_question").val(data.marks_per_each_question);
                $("#total_no_of_questions_to_ask").val(data.total_no_of_questions_to_ask);
                $("#total_no_of_questions_to_ans").val(data.total_no_of_questions_to_ans);                
                $("#question_type_order").val(data.question_type_order);                
                $("#sections").val(data.sections);                
                $("#sections_name").val(data.sections_name);                
                $("#sub_question_type_order").val(data.sub_question_type_order);                
                $("#child_sub_question_type_order").val(data.child_sub_question_type_order);                
            }
         })
    });

    //Update data fetch Here//
    $(document).on('click', '.view', function(){
        var ready_paper_id = $(this).attr("data-id");
        var board_id   = $(this).attr("data-board-id");
        var medium_id = $(this).attr("data-medium-id");
        var class_id = $(this).attr("data-class-id");
        var subject_id = $(this).attr("data-subject-id");
        var chapter_id = $(this).attr("data-chapter-id");
        var topic_id = $(this).attr("data-topic-id");
        var total_marks = $(this).attr("data-total-marks");
        var question_type_id = $(this).attr("data-question-type-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetReadyPaperStructureData",
            method:'get',
            data:{action:'view',ready_paper_id:ready_paper_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,question_type_id:question_type_id,total_marks:total_marks},
            dataType:'json',
            success:function(data)
            {
                //Board Data//
                $('#view_board_name').html("<br/>"+data.board_id);

                //Medium Data//
                $('#view_medium_name').html("<br/>"+data.medium_id);

                //class Data//
                $('#view_class_name').html("<br/>"+data.class_id);

                //Subject Data//
                $('#view_subject_name').html("<br/>"+data.subject_id);

                //Question type Data//
                $('#view_question_type').html(data.question_type);

                //Total Marks Data//
                $('#view_total_paper_marks').html("<br/>"+data.total_paper_marks);

                $('#view_board_id').val(data.board_id);
                $('#paperStructureViewModal').modal('show');
                $('.modal-title').text('View Data');
                $("#view_total_marks_as_per_question_type").html("<br/>"+data.total_marks_as_per_question_type);
                $("#view_marks_per_each_question").html("<br/>"+data.marks_per_each_question);
                $("#view_total_no_of_questions_to_ask").html("<br/>"+data.total_no_of_questions_to_ask);
                $("#view_total_no_of_questions_to_ans").html("<br/>"+data.total_no_of_questions_to_ans);                
                $("#view_question_type_order").html("<br/>"+data.question_type_order);                
                $("#view_sections").html("<br/>"+data.sections);                
                $("#view_sections_name").html("<br/>"+data.sections_name);                
                $("#view_sub_question_type_order").html("<br/>"+data.sub_question_type_order);                
                $("#view_child_sub_question_type_order").html("<br/>"+data.child_sub_question_type_order);                
            }
         })
    });

    //Delete Medium Here//
    var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var paper_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?")) {
            $.ajax({
                url: base_url + "/admin/deleteReadyPaperStructureData",
                method:"delete",
                data:{ready_paper_id:paper_id, _token:_token},
                success:function(data)
                {
                    $('#form_output').html(data);
                    fetchReadyPaperData();
                    window.location.reload();
                }
            });
        }
    });
});
</script>
</body>
</html>