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
                    <li class="breadcrumb-item"><a href="#!">Class Info</a></li>
                    <li class="breadcrumb-item"><a href="#!">Class Details</a></li>
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
            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModal" > <i class="fa-solid fa-plus"></i> Add New Class </button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Medium </label>
                            <select class="form-control" name="mediumName" id="mediumName">
                                <option value="">--Select Board--</option>
                                <option value="BOARD_BF9351DAA">CBSE</option>
                                <option value="BOARD_D50BE3EF0">ICSE</option>
                                <option value="BOARD_0040B44E3">JEE</option>
                                <option value="BOARD_F5DED60D5">MHCET</option>
                                <option value="BOARD_33E77AEF9">MHSB</option>
                                <option value="BOARD_2F32AB5FF">NEET</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Select Class Name:</label>
                            <!-- <input type="text" class="form-control" id="recipient-name"> -->
                            <select class="form-control" name="className" id="className">
                                <option value="">--Select Board--</option>
                                <option value="Medium_BF9351DAA">English</option>
                                <option value="Medium_D50BE3EF0">Science</option>
                                <option value="Medium_0040B44E3">Commerce</option>
                                <option value="Medium_F5DED60D5">हिंदी</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Class Name:</label>
                            <input type="text" class="form-control" id="className">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn  btn-primary">Send message</button>
                    </div>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Board </label>
                            <select class="form-control" name="mediumName" id="mediumName">
                                <option value="">--Select Board--</option>
                                <option value="BOARD_BF9351DAA">CBSE</option>
                                <option value="BOARD_D50BE3EF0">ICSE</option>
                                <option value="BOARD_0040B44E3">JEE</option>
                                <option value="BOARD_F5DED60D5">MHCET</option>
                                <option value="BOARD_33E77AEF9">MHSB</option>
                                <option value="BOARD_2F32AB5FF">NEET</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Select Medium:</label>
                            <!-- <input type="text" class="form-control" id="recipient-name"> -->
                            <select class="form-control" name="className" id="className">
                                <option value="">--Select Medium--</option>
                                <option value="Medium_BF9351DAA">English</option>
                                <option value="Medium_D50BE3EF0">Science</option>
                                <option value="Medium_0040B44E3">Commerce</option>
                                <option value="Medium_F5DED60D5">हिंदी</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Class Name:</label>
                            <input type="text" class="form-control" id="className" value="12th">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn  btn-primary">Send message</button>
                    </div>
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