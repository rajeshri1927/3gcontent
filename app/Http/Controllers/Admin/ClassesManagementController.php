<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\classesManagement;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;
use DB;


use Validator;

use Illuminate\Http\Request;

class ClassesManagementController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(){
      $data['BoardList'] = Board::get(["board_name", "board_id"]);
      $data['BoardList'] = $data['BoardList'] ?? collect();
      return view($this->module_view_folder.'.classesmanage', $this->arr_view_data,$data);
    }

    public function addClasses(Request $request){
      $user = Auth::user();
      $validation = Validator::make($request->all(), [
          'owner_name'    => 'required',
          'classes_name' => 'required',
          //'email'        => 'required|email|unique:classes_lists,email,'.$request->get('classes_id'),
          'password'     => 'required|min:6'
      ]);        
      $error_array = array();
      $success_output = '';
      if ($validation->fails())
      {
          foreach($validation->messages()->getMessages() as $field_name => $messages)
          {
              $error_array[] = $messages;
          }
      }
      else
      {
          if($request->get('button_action') == "insert")
          {
              $classesManagement = new classesManagement([
                  'owner_name'  => $request->get('owner_name'),
                  'classes_name'=> $request->get('classes_name'),
                  'contact_no'  => $request->get('contact_no'),
                  'email'       => $request->get('email'),
                  'password'    =>  Hash::make($request->password),
                  'classes_address'=> $request->get('classes_address'),
                  'board_id'   => implode(',', $request->board_id),
                  'medium_id'  => implode(',', $request->medium_id),
                  'class_id'   => implode(',', $request->class_id),
                  'classes_status' => $request->get('classes_status'),
                  'created_by'  => $user->name,
                  'creation_ip' => $_SERVER['REMOTE_ADDR']
              ]);
              //dd($classesManagement);
              $classesManagement->save();
              $success_output = '<div class="alert alert-success">Employee Data Added Successfully!! </div>';
          }
          if ($request->get('button_action') == 'update') {
              $employees = EmployeeManagent::find($request->get('id'));
              if ($employees) {
                  $employees->update([
                      'emp_name'    => $request->get('emp_name'),
                      'email'       => $request->get('email'),
                      'password'    => Hash::make($request->password),//$request->get('password'),
                      'contact_no'  => $request->get('contact_no'),
                      'role'        => $request->get('role'),
                      'role_id'     => $request->get('role_id'),
                      'status'      => $request->get('status'),
                      'modified_by' => $user->name,
                      'modified_ip' => $_SERVER['REMOTE_ADDR']
                  ]);
          
                  $success_output = '<div class="alert alert-success">Employee Data Updated !!!</div>';
              } else {
                  // Handle the case when the board is not found
                  $success_output = '<div class="alert alert-danger">Employee not found</div>';
              }
          }
      }
      $output = array(
          'error'     =>  $error_array,
          'success'   =>  $success_output
      );
      echo json_encode($output);
    }

    public function getclassesAllData(){
        $error_array = array();
        $success_output = '';
      //   $subject = EmployeeManagent::select(
      //     'classes_lists.*',
      //     'class.class_name',
      //     'class.class_id',
      //     'boards.board_id',
      //     'boards.board_name',
      //     'mediums.medium_name',
      //     'mediums.medium_id',
      // )
      // ->join('class', 'class.class_id', '=', 'subjects.class_id')
      // ->join('mediums', 'subjects.medium_id', '=', 'mediums.medium_id')
      // ->join('boards', 'class.board_id', '=', 'boards.board_id')
      // ->orderBy('subjects.subject_id', 'asc')
      // ->get();
      $classesLists = classesManagement::select(
        'classes_lists.*',
        'class.class_name',
        'class.class_id',
        DB::raw('GROUP_CONCAT(boards.board_name) as board_names'),
        DB::raw('GROUP_CONCAT(boards.board_id) as board_ids'),
        'mediums.medium_name',
        'mediums.medium_id'
    )
    ->join('class', 'class.class_id', '=', 'classes_lists.class_id')
    ->join('boards', 'classes_lists.board_id', '=', 'boards.board_id')
    ->join('mediums', 'classes_lists.medium_id', '=', 'mediums.medium_id')
    ->groupBy('classes_lists.classes_id') // Group by primary key
    ->orderBy('classes_lists.classes_id', 'asc')
    ->get();

        if($classesLists){
            $success_output = '<div class="alert alert-success">Get All Employee Data !!!</div>';
        }else{
            $error_array = '<div class="alert alert-danger">Employee Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($classesLists);
    }

    public function deleteClassesData(Request $request)
    {
        $empId = $request->id;
        if (!is_null($empId)) {
            $employee = classesManagement::find($empId);

            if ($employee) {
                $employee->update(['status' => 'No']);
                echo '<div class="alert alert-success">Employee Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Employee not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Employee ID'], 400);
        }
    }
}
