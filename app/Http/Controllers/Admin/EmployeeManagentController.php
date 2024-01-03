<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\EmployeeManagent;
use Validator;
use DataTables;

class EmployeeManagentController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {
        return view($this->module_view_folder.'.employeemanage', $this->arr_view_data);
    }

    public function addEmployee(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'emp_name' => 'required',
            'email'    => 'required|email|unique:users,email,'.$request->get('id'),
            'password' => 'required|min:6'
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
                $employees = new EmployeeManagent([
                    'emp_name'    => $request->get('emp_name'),
                    'email'       => $request->get('email'),
                    'password'    => Hash::make($request->password),//$request->get('password'),
                    'contact_no'  => $request->get('contact_no'),
                    'role'        => $request->get('role'),
                    'role_id'     => $request->get('role_id'),
                    'status'      => $request->get('status'),
                    'created_by'  => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $employees->save();
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

    public function getEmpAllData(){
        $error_array = array();
        $success_output = '';
        $userList = EmployeeManagent::select('*')->where('role_id', 2)->orderBy('id', 'DESC')->get();
        if($userList){
            $success_output = '<div class="alert alert-success">Get All Employee Data !!!</div>';
        }else{
            $error_array = '<div class="alert alert-danger">Employee Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($userList);
    }

    public function updateGetEmpData(Request $request)
    {
        $id   = $request->input('id');
        $employee = EmployeeManagent::find($id);
        $output  = array(
            'id'            => $employee->id,
            'emp_name'      => $employee->emp_name,
            'email'         => $employee->email,
            'password'      => $employee->password,
            'contact_no'    => $employee->contact_no,
            'role'          => $employee->role,
            'status'        => $employee->status
        );
        echo json_encode($output);
    }
    
    public function deleteEmployeeData(Request $request)
    {
        $empId = $request->id;
        if (!is_null($empId)) {
            $employee = EmployeeManagent::find($empId);

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
