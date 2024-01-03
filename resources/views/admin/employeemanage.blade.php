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
          <h5 class="m-b-10">User Manage Here</h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">User Info</a></li>
          <li class="breadcrumb-item"><a href="#!">User Details</a></li>
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
      <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#empModal" > <i class="fa-solid fa-plus"></i> Add New Employee </button>
    </div>
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="empModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="empModalLabel">Add New Employee</h5>
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
                     <label for="employee_name">Employee Name</label>
                     <input type="text" class="form-control formField" required id="emp_name" name="emp_name" placeholder="Enter Employee Name">
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
                      <label for="subject_description">Select Role</label>
                        <select class="form-control" name="role" id="role">
                          <option value="">--Select Role--</option>
                          <option value="Project Manager">Project Manager</option>
                          <option value="Software Developer">Software Developer</option>
                          <option value="Copy Writer">Copy Writer</option>
                          <option value="Support">Support</option>
                          <option value="Proof Reader">Proof Reader</option>
                        </select>
                      <!-- <input type="text" name="subject_description" id="subject_description" class="form-control" placeholder="Enter subject Description. *"> -->
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="subject_description">Employee Status</label>
                      <select class="form-control" name="status" id="status">
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
    // function validateForm() {
    //     // Validation of the values of form elements 
    //     let name    = document.addemployee.name.value;
    //     let email   = document.addemployee.email.value;
    //     let mobile  = document.addemployee.mobile.value;
    //     let country = document.addemployee.country.value;
    //     let gender  = document.addemployee.gender.value;

    // }
    // // Validate name
    // if(name == "") {
    //     printError("nameErr", "Please enter your name");
    // } else {
    //     let regex = /^[a-zA-Z\s]+$/;                
    //     if(regex.test(name) === false) {
    //         printError("nameErr", "Please enter a valid name");
    //     } else {
    //         printError("nameErr", "");
    //         nameErr = false;
    //     }
    // }
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