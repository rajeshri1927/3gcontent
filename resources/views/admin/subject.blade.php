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
          <h5 class="m-b-10">Class Here</h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="#!">Subject Info</a></li>
          <li class="breadcrumb-item"><a href="#!">Subject Details</a></li>
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
      <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#subjectModal" > <i class="fa-solid fa-plus"></i> Add New Class </button>
    </div>
    <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form role="form" id="addSubjectFrm" name="addSubjectFrm" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="boardname">Select Board</label>
                      <select class="form-control" name="boardname" id="boardname">
                        <option value="">--Select Board--</option>
                        <option value="BOARD_BF9351DAA">CBSE</option>
                        <option value="BOARD_D50BE3EF0">ICSE</option>
                        <option value="BOARD_0040B44E3">JEE</option>
                        <option value="BOARD_F5DED60D5">MHCET</option>
                        <option value="BOARD_33E77AEF9">MHSB</option>
                        <option value="BOARD_2F32AB5FF">NEET</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="medium">Medium</label>
                      <select class="form-control" id="medium" name="medium">
                        <option value="">--Select Medium--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="classname">Select Class</label>
                      <select class="form-control" id="classname" name="classname">
                        <option value="">--Select Class--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="subjectname">Subject Name</label>
                      <input type="text" name="subjectname" id="subjectname" class="form-control" placeholder="Enter subject name. *">
                    </div>
                  </div>
                  <div class="col-sm-3"></div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <button class="btn btn-primary btn-secondary" data-dismiss="modal" type="button" name="addSubjectBtn" id="addSubjectBtn">Cancel</button>
                    <button class="btn btn-primary" type="button" name="addSubjectBtn" id="addSubjectBtn">Add Subject</button>
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
        <table class="table table-striped table-bordered ">
          <thead>
            <tr>
              <th>#</th>
              <th>Class Name</th>
              <th>Class Name</th>
              <th>Created Date / Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Mark</td>
              <td>Otto</td>
              <td>18 Dec 2023 11.30 PM</td>
              <td>
                <button class="btn btn-sm btn-warning mt-1" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" data-toggle="modal" data-target="#editModal" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" data-toggle="modal" data-target="#deleteModal" onclick="deleteClassDetail(this);" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>18 Dec 2023 11.30 PM</td>
              <td>
                <button class="btn btn-sm btn-warning mt-1" data-toggle="modal" data-target="#editModal" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" data-toggle="modal" data-target="#deleteModal" onclick="deleteClassDetail(this);" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Larry</td>
              <td>the Bird</td>
              <td>18 Dec 2023 11.30 PM</td>
              <td>
                <button class="btn btn-sm btn-warning mt-1" data-toggle="modal" data-target="#editModal" data-id="MED_DB20C156D75" onclick="editClassDetail(this);" title="Change Class Details" fdprocessedid="9o67l"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger mt-1" data-id="MED_DB20C156D75" onclick="deleteClassDetail(this);" data-toggle="modal" data-target="#deleteModal" title="Delete Class Details" fdprocessedid="33khcl"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Edit Class Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form role="form" id="addSubjectFrm" name="addSubjectFrm" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="boardname">Select Board</label>
                      <select class="form-control" name="boardname" id="boardname">
                        <option value="">--Select Board--</option>
                        <option value="BOARD_BF9351DAA">CBSE</option>
                        <option value="BOARD_D50BE3EF0">ICSE</option>
                        <option value="BOARD_0040B44E3">JEE</option>
                        <option value="BOARD_F5DED60D5">MHCET</option>
                        <option value="BOARD_33E77AEF9">MHSB</option>
                        <option value="BOARD_2F32AB5FF">NEET</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="medium">Medium</label>
                      <select class="form-control" id="medium" name="medium">
                        <option value="">--Select Medium--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="classname">Select Class</label>
                      <select class="form-control" id="classname" name="classname">
                        <option value="">--Select Class--</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="subjectname">Subject Name</label>
                      <input type="text" name="subjectname" id="subjectname" class="form-control" placeholder="Enter subject name. *">
                    </div>
                  </div>
                  <div class="col-sm-3"></div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <button class="btn btn-primary btn-secondary" data-dismiss="modal" type="button" name="addSubjectBtn" id="addSubjectBtn">Cancel</button>
                    <button class="btn btn-primary" type="button" name="addSubjectBtn" id="addSubjectBtn">Add Subject</button>
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
    <!-- End Class Modal -->
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