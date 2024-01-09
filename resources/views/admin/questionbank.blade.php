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
          <h5 class="m-b-10">Manage Questions ( Total : <?php echo $question_bank_count;?>)</h5>
        </div>
        <!-- <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">Manage Questions Info</a></li>
          <li class="breadcrumb-item"><a href="#!">Manage Questions Details</a></li>
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
          <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#questionModal" > <i class="fa-solid fa-plus"></i> Add New Question </button>
    </div>
    <div class="modal-body">
      <form autocomplete="off" id="filterAddQuestion" method="post">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-2 form-group">
            <label for="recipient-name" class="col-form-label">Select Board </label>
            <select class="form-control formField" name="filter_board_id" id="filter_board_id">
              <option value="">--- Select Board ---</option>
              @if(!empty($BoardList))
              @foreach($BoardList as $data)
              <option value="{{$data->board_id}}">{{$data->board_name}}</option>
              @endforeach
              @endif
            </select>
          </div>
          <div class="col-md-2 form-group">
            <label for="medium_id" class="col-form-label">Select Medium </label>
            <select class="form-control formField" name="filter_medium_id" id="filter_medium_id">
              <option value="">--- Select Medium ---</option>
            </select>
          </div>
          <div class="col-md-2 form-group">
            <label for="class_id" class="col-form-label">Select Class:</label>
            <select class="form-control formField" name="filter_class_id" id="filter_class_id">
              <option value="">--- Select Class ---</option>
            </select>
          </div>
          <div class="col-md-2 form-group">
            <label for="subject_id" class="col-form-label">Select Subject:</label>
            <select class="form-control formField" name="filter_subject_id" id="filter_subject_id">
              <option value="">--- Select Subject ---</option>
            </select>
          </div>
          <div class="col-md-2 form-group">
            <label for="chapter_id" class="col-form-label">Select Chapter:</label>
            <select class="form-control formField" name="filter_chapter_id" id="filter_chapter_id">
              <option value="">--- Select Chapter ---</option>
            </select>
          </div>
          <div class="col-md-2 form-group">
            <label for="topic_id" class="col-form-label">Select Topic:</label>
            <select class="form-control" name="filter_topic_id" id="filter_topic_id">
              <option value="">--- Select Topic ---</option>
            </select>
          </div>
        </div>
        <!-- <div class="modal-footer"> -->
          <!-- <input type="hidden" name="question_id" id="question_id" value="" /> -->
          <input type="hidden" name="filter_button_action" id="filter_button_action" value="insert" />
          <button type="button" name="button" id="filterBtn" class="btn  btn-primary">Apply</button>
          <a href="#"> <button type="button" name="button" id="filterresetBtn" class="btn  btn-primary">Reset</button></a>
         <!-- <input type="reset" name="reset" id="reset" class="btn  btn-primary" value="Reset"></a> -->
        <!-- </div> -->
      </form>
    </div>
    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
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
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
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
                <input type="hidden" name="question_id" id="question_id" value="" />
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
        <table class="table table-striped table-bordered data-table" id="question_table">
          <thead>
            <tr>
              <th></th>
              <th>Sr.No</th>
              <th>Board</th>
              <th>Medium</th>
              <th>Class</th>
              <th>Subject</th>
              <th>Chapter</th>
              <th>Marks</th>
              <th>Type</th>
              <th>Question</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="question_list_data"></tbody>
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

    </div>
    <!-- /.modal -->
    <!---  View Model Question Bank -->
    <div class="modal fade" id="ViewQuestionModal" tabindex="-1" role="dialog" aria-labelledby="ViewQuestionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="ViewQuestionModalLabel">Question Details</h5>
            <button id="ViewQuestionModalClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
          <div class="table-responsive">
            <span id="form_output"></span>
            <table class="table table-striped table-bordered data-table example1" id="example1">
            <thead>
                <tr>
                    <th>Board</th>
                    <td id="board_name"></td>
                </tr>
                <tr>
                    <th>Medium</th>
                    <td id="medium_name"></td>
                </tr>
                <tr>
                    <th>Class</th>
                    <td id="class_name"></td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td id="subject_name"></td>
                </tr>
                <tr>
                    <th>Chapter</th>
                    <td id="chapter_name"></td>
                </tr>
                <tr>
                    <th>Marks</th>
                    <td id="mark"></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td id="view_question_type"></td>
                </tr>
                <tr>
                    <th>Question</th>
                    <td id="view_question"></td>
                <tr>
                <tr>
                    <th>Solution</th>
                    <td id="view_solution"></td>
                <tr>
                <tr>
                    <th>Created On</th>
                    <td id="created_on"></td>
                </tr>
            </thead>
            </table>
        </div>

          </div>
        </div>
      </div>
    </div>
    <!--- End Question Bank Model -->
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>-->
<!-- <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>-->
<!-- <script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>-->
<script>
  $(document).ready(function() {
  
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
          var class_id   = $("#class_id").val();
          var subject_id = $("#subject_id").val();
          var chapter_id = this.value;
          $.ajax({
              url: base_url + "/admin/getTopicAjax",
              method:"GET",
              data:{chapter_id:chapter_id},
              success:function(result){
                  console.log(result);
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
          } else if(questionType=="MCQ") {
              $("#mcqForm").show();
              $("#trueFalseFrom, #writtenQuestions").hide();
          } else if (questionType=="True or False") {
              $("#mcqForm").hide();
              $("#trueFalseFrom").show();
              $("#writtenQuestions").hide();
          } else{
              $("#mcqForm, #trueFalseFrom").hide();
              $("#qt").html("("+questionType+")");
              $("#writtenQuestions").show();
          }
      });
  
      //View/Get data in html format Here//
      fetchQuestionData();
      function fetchQuestionData(filterClicked='')
      {
          if(filterClicked){
            var binfo    = true;
            var paging   = true;
            var board_id = $("#filter_board_id").val();
            var medium_id = $("#filter_medium_id").val();
            var class_id = $("#filter_class_id").val();
            var subject_id = $("#filter_subject_id").val();
            var chapter_id = $("#filter_chapter_id").val();
            var topic_id = $("#filter_topic_id").val();
            var table   = $('#question_table').DataTable({
              "destroy": true,
                "processing": true,
                "serverSide": true,
                ajax: {
                    url:  base_url + "/admin/getQuestionAllData",
                    data: {_token:_accessToken,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id},
                },
                "bAutoWidth": false,
                "searching": true,
                "ordering": false,
                "bInfo": binfo,
                "bLengthChange": true,
                "paging": paging,
                "bPaginate": true,
                "pageLength": 10,
                "responsive": true,
                "bAutoWidth": false,
                "searching": true,
                "ordering": false,
                "bInfo": binfo,
                "bLengthChange": true,
                "paging": paging,
                "bPaginate": true,
                "pageLength": 10,
                "responsive": true,
                columns: [
                    {data: 'delete', name: 'delete'},
                    // {data: 'question_id', name: 'question_id'},
                    {data: 'board_name', name: 'board_details.board_name', className: 'text-center' },
                    {data: 'medium', name: 'medium_details.medium',className: "text-center"},
                    {data: 'class_name', name: 'class_details.class_name',className: "text-center"},
                    {data: 'subject_name', name: 'subject_details.subject_name',className: "text-center"},
                    {data: 'chapter_name', name: 'chapter_details.chapter_name',className: "text-center"},
                    {data: 'marks', name: 'marks',className: "text-center"},
                    {data: 'question_type', name: 'question_type',className: "text-center"},
                    {data: 'question', name: 'question',className: "text-center"},
                    {data: 'created_at', name: 'created_at',className: "text-center"},
                    {
                        data: 'built_action_btns',
                        name: 'built_action_btns',
                        className: 'text-center',
                        orderable: false, // Disable sorting for this column
                        searchable: false, // Disable searching for this column
                    }
                ],
                "order": [[ 0, "desc" ]],
                fixedHeader: {
                    header: true
                }
            });
          } else {
            var binfo    = true;
            var paging   = true;
            var table   = $('#question_table').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                ajax: {
                    url:  base_url + "/admin/getQuestionAllData",
                    data: {

                    },
                },
                "bAutoWidth": false,
                "searching": true,
                "ordering": false,
                "bInfo": binfo,
                "bLengthChange": true,
                "paging": paging,
                "bPaginate": true,
                "pageLength": 10,
                "responsive": true,
                columns: [
                    {data: 'delete', name: 'delete'},
                    // {data: 'question_id', name: 'question_id'},
                    {data: 'board_name', name: 'board_details.board_name', className: 'text-center' },
                    {data: 'medium', name: 'medium_details.medium',className: "text-center"},
                    {data: 'class_name', name: 'class_details.class_name',className: "text-center"},
                    {data: 'subject_name', name: 'subject_details.subject_name',className: "text-center"},
                    {data: 'chapter_name', name: 'chapter_details.chapter_name',className: "text-center"},
                    {data: 'marks', name: 'marks',className: "text-center"},
                    {data: 'question_type', name: 'question_type',className: "text-center"},
                    {data: 'question', name: 'question',className: "text-center"},
                    {data: 'created_at', name: 'created_at',className: "text-center"},
                    {
                        data: 'built_action_btns',
                        name: 'built_action_btns',
                        className: 'text-center',
                        orderable: false, // Disable sorting for this column
                        searchable: false, // Disable searching for this column
                    }
                ],
                "order": [[ 0, "desc" ]],
                fixedHeader: {
                    header: true
                }
            });
          }
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
              var form_data = $(this).serializeArray();
              console.log(form_data);
              $.ajax({ 
                  url: base_url + "/admin/addQuestion",
                  method:"POST",
                  data:form_data,
                  dataType:"json",
                  success:function(data){
                      console.log(data);
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
  
      //View data fetch Here//
       $(document).on('click', '.view', function(){
            var question_id      = $(this).attr("data-id");
            var board_id         = $(this).attr("data-board-id");
            var medium_id        = $(this).attr("data-medium-id");
            var class_id         = $(this).attr("data-class-id");
            var subject_id       = $(this).attr("data-subject-id");
            var chapter_id       = $(this).attr("data-chapter-id");
            var topic_id         = $(this).attr("data-topic-id");
            var marks            = $(this).attr("data-total-marks");
            var question         = $(this).attr("data-question");
            var question_type    = $(this).attr("data-questionType");
            var created_on       = $(this).attr("data-created_on");
            $('#form_output').html('');
           $.ajax({
              url: base_url + "/admin/updateGetQuestionData",
              method:'get',
              data:{action:'view',question_id:question_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id,question:question,question_type:question_type,marks:marks,created_on:created_on},
              dataType:'json',
              success:function(data)
              {
                console.log(data);
                
                  //Board Data//
                  $('#board_name').html("<br/>"+data.board_id);
  
                  //Medium Data//
                  $('#medium_name').html("<br/>"+data.medium_id);
  
                  //class Data//
                  $('#class_name').html("<br/>"+data.class_id);
  
                  //Subject Data//
                  $('#subject_name').html("<br/>"+data.subject_id);
  
                  //Question type Data//
                  $('#view_question_type').html("<br/>"+ data.question_type);

                  //Total Marks Data//
                  $('#chapter_name').html("<br/>"+data.chapter_id);

                  //Total Marks Data//
                  $('#mark').html("<br/>"+data.marks);
                  $('#view_question').html("<br/>"+data.question);
                  $('#view_solution').html("<br/>"+data.solution);
                  $('#created_on').html("<br/>"+data.created_on);
                  $('#ViewQuestionModal').modal('show');
                  $('.modal-title').text('View Data');
                //   $("#view_total_marks_as_per_question_type").html("<br/>"+data.total_marks_as_per_question_type);
                //   $("#view_marks_per_each_question").html("<br/>"+data.marks_per_each_question);
                //   $("#view_total_no_of_questions_to_ask").html("<br/>"+data.total_no_of_questions_to_ask);
                //   $("#view_total_no_of_questions_to_ans").html("<br/>"+data.total_no_of_questions_to_ans);                
                //   $("#view_question_type_order").html("<br/>"+data.question_type_order);                
                //   $("#view_sections").html("<br/>"+data.sections);                
                //   $("#view_sections_name").html("<br/>"+data.sections_name);                
                //   $("#view_sub_question_type_order").html("<br/>"+data.sub_question_type_order);                
                //   $("#view_child_sub_question_type_order").html("<br/>"+data.child_sub_question_type_order);                
              }
           })
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
          var question_id  = $(this).attr("data-id");
          var board_id     = $(this).attr("data-board-id");
          var medium_id    = $(this).attr("data-medium-id");
          var class_id     = $(this).attr("data-class-id");
          var subject_id   = $(this).attr("data-subject-id");
          var chapter_id   = $(this).attr("data-chapter-id");
          var topic_id     = $(this).attr("data-topic-id");
          var question_type_id = $(this).attr("data-questionType");
           $('#form_output').html('');
           $.ajax({
              url: base_url + "/admin/updateGetQuestionData",
              method:'post',
              data:{_token:_accessToken,question_id:question_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id,question_type_id:question_type_id},
              // data:{_token:_accessToken,question_bank_id:question_bank_id,board_id:board_id,medium_id:medium_id,class_id:class_id,subject_id:subject_id,chapter_id:chapter_id,topic_id:topic_id,question_type_id:question_type_id},
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
  
                  //Question Type Data//
                  /* var htmlQuestionTypeString = data.question_type;
                  var optionQuestionType = $(htmlQuestionTypeString);
                  // Iterate over the options
                  optionQuestionType.each(function(index,questionType) {
                      optionQuestionType.filter(':contains("2")').prop('selected', true);
                  });
                  $('#question_type_id').html(optionQuestionType); */
                  $('#question_type_id').val(data.question_type);

                  $("#question").summernote('code', data.question);
                  $("#solution").summernote('code', data.solution);
                  
                  $("#question_type_id").trigger("change");
                  $("#question_type_id").trigger("change");
                  $('#board_id').val(data.board_id);
                  $('#dificultyLevel').val(data.level);
                  $('#question_status').val(data.question_status);
                  $('#marks').val(data.marks);
                  $('#question_id').val(question_id);
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
                     // window.location.reload();
                  }
              });
          }
    });
      
    $(document).on('click', '#select_all', function() {
      $(".selectQuestionCheckbox").prop("checked", this.checked);
      $("#select_count").html($("input.selectQuestionCheckbox:checked").length+" Selected");
    });
    $(document).on('click', '.selectQuestionCheckbox', function() {
      if ($('.selectQuestionCheckbox:checked').length == $('.selectQuestionCheckbox').length) {
        $('#select_all').prop('checked', true);
      } else {
        $('#select_all').prop('checked', false);
      }
          $("#select_count").html($("input.selectQuestionCheckbox:checked").length+" Selected");
    });
    
    $('#delete_records').on('click', function(e) {
      var question_delete = [];
      $(".selectQuestionCheckbox:checked").each(function() {
        question_delete.push($(this).attr('data-question-id'));
    
      });
      if(question_delete.length <=0) {
              alert("Please select records."); 
          }else{
              WRN_PROFILE_DELETE = "Are you sure you want to delete "+(question_delete.length>1?"these question details":"this question detail")+" ? \nNote:- After delete you can not access this data.";
              var checked = confirm(WRN_PROFILE_DELETE);
              if(checked == true) {
              var selected_values = question_delete.join(",");
              $.ajax({
                url: base_url + "/admin/deleteMultipleQuestionData",
                method: 'post',
                data: {_token:_accessToken,question_ids:selected_values},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#delete_records').prop('disabled', true);
                    $('#form_output').html(response);
                    setInterval('location.reload()', 1000);
                    fetchQuestionData();
                }
              });
          }
          }
  })
  
  $("#filterBtn").on("click",function(){ 
          var filterClicked = 1;
          fetchQuestionData(filterClicked);
    });  
});
</script>
</body>
</html>