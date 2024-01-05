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
                    <h5 class="m-b-10">Manage MCQ Question Paper Here</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Manage MCQ Question Paper Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Manage MCQ Question Paper Details</a></li>
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
            <a href="{{ url('/admin/createmcqpaper') }}" class="btn btn-primary"> <i class="fa-solid fa-plus"></i> Create Paper </a>
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
                            <th>Created by</th>
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
<style>
    .empty-border {
      border: 1px solid red; /* Customize the border style */
    }
    .filled-border {
      border: 2px solid rgba(0, 0, 0, 0.15); /* Customize the border style */
    }
</style>
<script>
$(document).ready(function() {
    //View/Get data in html format Here//
    fetchQuestionPaperData();
    function fetchQuestionPaperData()
    {
        $.ajax({
            url: base_url + "/admin/getQuestionPaperAllData",
            dataType:"json",
            success:function(data) {
                var html = '';
                
                for(var count=0; count < data.length; count++) {
                    html +='<tr>';
                    var createdAtDate = new Date(data[count].created_at);
                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', options);
                    console.log(count);
                    html +='<td contenteditable class="column_name" data-column_name="mcq_id" data-id="'+data[count].id+'">'+(parseInt(count))+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="board_name" data-id="'+data[count].id+'">'+data[count].board_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="medium_name" data-id="'+data[count].id+'">'+data[count].medium+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="class_name" data-id="'+data[count].id+'">'+data[count].class_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="subject_name" data-id="'+data[count].id+'">'+data[count].subject_name+'</td>';
                    html +='<td contenteditable class="column_name" data-column_name="created_by" data-id="'+data[count].id+'">'+data[count].created_by+'</td>';
                    html += '<td data-column_name="created_at" data-id="' + data[count].id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
                    html += '<td>';

                    var viewOpen = '<?php echo url("/admin/viewMCQPaper");?>';

                    html += '<button class="btn btn-sm btn-secondary mt-1 viewQP" onclick="window.open('+"'"+viewOpen+"/"+data[count].id+"'"+')" type="button" data-id="'+data[count].id+'" title="View Question Paper"><i class="fas fa-eye"></i></button>';
                    html += '<button class="btn btn-sm btn-primary mt-1 ml-2 viewQPS" type="button" data-id="'+data[count].id+'" title="View Answer Paper"><i class="fas fa-eye"></i></button>';
                    html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'+data[count].id+'" data-toggle="modal"  title="Delete Question Paper"><i class="fas fa-trash-alt"></i></button>';
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
    
    // Delete MCQ Question Paper Here//
    // var _token = $('input[name="_token"]').val();
    $(document).on('click', '#delete', function(){
        var question_id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?")) {
            $.ajax({
                url: base_url + "/admin/deleteMCQPaper",
                method:"delete",
                data:{question_id:question_id, _token:_accessToken},
                success:function(data)
                {
                    $('#form_output').html(data);
                    fetchQuestionPaperData();
                    window.location.reload();
                }
            });
        }
    });
});
</script>
</body>
</html>