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
          <h5 class="m-b-10">Classes Manage Here</h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">Classes Info</a></li>
          <li class="breadcrumb-item"><a href="#!">Classes Details</a></li>
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
      <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#classesModal" > <i class="fa-solid fa-plus"></i> Add New Classes </button>
    </div>
    <div class="modal fade" id="classesModal" tabindex="-1" role="dialog" aria-labelledby="classespModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="classespModalLabel">Add New Classes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form  id="addemployee" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control formField" value="2" id="role_id" name="role_id" placeholder="Enter User Id">
            {{ csrf_field() }}  
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                     <label for="employee_name">Owner Name</label>
                     <input type="text" class="form-control formField" required id="owner_name" name="owner_name" placeholder="Enter Owner Name">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                     <label for="employee_name">Classes Name</label>
                     <input type="text" class="form-control formField" required id="classes_name" name="classes_name" placeholder="Enter Owner Name">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="classname">Phone Number</label>
                      <input type="text" class="form-control formField" id="contact_no" name="contact_no" required placeholder="Enter Phone Number Here">                    
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                     <label for="employee_name">Email</label>
                     <input type="text" class="form-control formField" id="email" name="email" required placeholder="Enter Email Here">                   
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="text" name="password" id="password" class="form-control" required placeholder="Enter Password Here. *">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password">Classes Address</label>
                      <textarea type="text" name="classes_address" id="classes_address" class="form-control" required placeholder="Enter Classes Address Here. *"></textarea>
                    </div>
                  </div>
                  <!-- <div class="col-sm-4">
                    <div class="form-group">
                      <label for="subject_description">Select Board</label>
                        <select class="form-control formField" name="board_id" id="board_id">
                            <option value="">--- Select Board ---</option>
                            @if(!empty($BoardList))
                                @foreach($BoardList as $data)
                                    <option value="{{$data->board_id}}">{{$data->board_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="medium_id">Select Medium</label>
                        <select class="form-control formField" name="medium_id" id="medium_id">
                            <option value="">--- Select Medium ---</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label for="class_id">Select Class:</label>
                        <select class="form-control formField" name="class_id" id="class_id" multiple>
                            <option value="">--- Select Class ---</option>
                        </select>
                    </div>
                  </div> -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="classes_status">Classes Status</label>
                      <select class="form-control" name="classes_status" id="classes_status">
                          <option value="">--Select Status--</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                      <input type="hidden" name="id" id="id" value=""/>
                      <input type="hidden" name="button_action" id="button_action" value="insert" />
                      <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit"  name="submit" id="action" class="btn  btn-primary" value="Add Employee">
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
              <th>Sr.No</th>
              <th>Employee Name</th>
              <th>Empoyee Email</th>
              <th>Contac No</th>
              <th>Deperatment</th>
              <th>Status</th>
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
@include('admin.layouts.footer');

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
                  $('#medium_id').html('<option value="">Select Medium</option>');
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
                  $('#class_id').html('<option value="">Select Class</option>');
                  $('#class_id').append(result);
                }else{
                  $('#class_id').html('<option value="">No Class</option>');
                }
            }
        });
    });
//View/Get data in html format Here//
   getAllUserData();
   function getAllUserData()
   {
    $.ajax({
     url: base_url + "/admin/getEmpAllData",
     dataType:"json",
     success:function(data)
    {
      var html = '';
  for(var count=0; count < data.length; count++)
      {
        html +='<tr>';
        var createdAtDate = new Date(data[count].created_at);
          var formattedCreatedAt = createdAtDate.toLocaleDateString('en-US', {
              year: 'numeric',
              month: 'short',
              day: 'numeric'
          });
        html +='<td  class="column_name" data-column_name="id" data-id="'+data[count].id+'">'+data[count].id+'</td>';
        html +='<td  class="column_name" data-column_name="name" data-id="'+data[count].id+'">'+data[count].emp_name+'</td>';
        html +='<td  class="column_name" data-column_name="email" data-id="'+data[count].id+'">'+data[count].email+'</td>';
        html +='<td  class="column_name" data-column_name="contact_no" data-id="'+data[count].id+'">'+data[count].contact_no+'</td>';
        html += '<td  class="column_name" data-column_name="role" data-id="'+data[count].id+'">'+data[count].role+'</td>';
        html += '<td  class="column_name" data-column_name="status" data-id="'+data[count].id+'">'+data[count].status+'</td>';
        html += '<td data-column_name="created_at" data-id="' + data[count].id + '">' + formattedCreatedAt + '</td>'; // Display formatted date
        html += '<td>';
        html += '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id ="'+data[count].id+'" data-toggle="modal"  title="Update Class Details"><i class="fas fa-edit"></i></button>';
        html += '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button"  data-id="'+data[count].id+'" data-toggle="modal"  title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
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
    $('#addemployee').on('submit', function(event){ 
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({ 
            url: base_url + "/admin/addEmployee",
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
                        $('#addEmployee').trigger('reset'); 
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                        $("#empModal").modal("hide");
                        setInterval('location.reload()', 4000);   
                    }
                }
        });
    });

    //Update data fetch Here//
  $(document).on('click', '.update', function(){
         var id = $(this).attr("data-id");
         $('#form_output').html('');
         $.ajax({
            url: base_url + "/admin/updateGetEmpData",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                $('#emp_name').val(data.emp_name);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#contact_no').val(data.contact_no);
                $('#role').val(data.role);
                $('#status').val(data.status);
                $('#id').val(data.id);
                $('#empModal').modal('show');
                $('#action').val('Update');
                $('.modal-title').text('Update Employee Data');
                $('#button_action').val('update');
            }
         })
   });

  //Delete subject Here//
  var _token = $('input[name="_token"]').val();
  $(document).on('click', '#delete', function(){
        var id = $(this).attr("data-id");
        if(confirm("Are you sure you want to delete this records?"))
        {
        $.ajax({
        url: base_url + "/admin/deleteEmployeeData",
        method:"delete",
        data:{id:id, _token:_token},
        success:function(data)
        {
            $('#form_output').html(data);
            setInterval('location.reload()', 4000);   
            getAllUserData();
        }
        });
        }
    });

  });
</script> 
</body>
</html>