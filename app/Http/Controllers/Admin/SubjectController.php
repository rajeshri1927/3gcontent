<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;
use Validator;
use DataTables;

class SubjectController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(){
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.subject', $this->arr_view_data,$data);
    }

    public function getClass(Request $request){
        $classList = Standard::where('medium_id',$request->medium_id)->get();
        $html = '';
        foreach ($classList as $classDet) {
            $html .= '<option value="' . $classDet->class_id . '">' . $classDet->class_name . '</option>';
        }        
        echo $html;
    }

    public function addSubject(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'subject_name'  => 'required'
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
                $subject = new Subject([
                    'subject_id'     => strtoupper(substr(uniqid("sub"."_".md5(uniqid("sub", true))), 0,15)),
                    'board_id'       => $request->get('board_id'),
                    'medium_id'      => $request->get('medium_id'),
                    'class_id'       => $request->get('class_id'),
                    'subject_name'   => $request->get('subject_name'),
                    'subject_status' => $request->get('subject_status'),
                    'created_by'     => $user->emp_name,
                    'creation_ip'    => $_SERVER['REMOTE_ADDR']
                ]);
                $subject->save();
                $success_output = '<div class="alert alert-success">Subject Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $subject = Subject::find($request->get('subject_id'));
                if ($subject) {
                    $subject->update([
                        'board_id'      =>  $request->get('board_id'),
                        'medium_id'     =>  $request->get('medium_id'),
                        'class_id'      => $request->get('class_id'),
                        'subject_name'  => $request->get('subject_name'),
                        'subject_status' => $request->get('subject_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
                    
                    $success_output = '<div class="alert alert-success">Subject Data Updated !!!</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Subject not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function getSubjectAllData(){
        $error_array = array();
        $success_output = '';
        $subject = Subject::select(
            'subject_details.*',
            'class_details.class_name',
            'class_details.class_id',
            'board_details.board_id',
            'board_details.board_name',
            'medium_details.medium',
            'medium_details.medium_id'
        )
        ->join('class_details', 'class_details.class_id', '=', 'subject_details.class_id')
        ->join('board_details', 'subject_details.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'subject_details.medium_id', '=', 'medium_details.medium_id')
        ->orderBy('subject_details.subject_id', 'asc')
        ->get();
        
        if($subject){
            $success_output = '<div class="alert alert-success">Get Subject Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">Subject Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($subject);
    }

    public function updateGetSubjectData(Request $request){
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $class_id   = $request->input('class_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $isSelected = ($mediumDet->medium_id == $medium_id) ? 'selected' : '';
            $html .= '<option value="' . $mediumDet->medium_id . '" ' . $isSelected . '>' . $mediumDet->medium. '</option>';
        }  

        $htmlClass = '';
        foreach ($classList as $classDet) {
            $isSelected = ($classDet->class_id == $class_id) ? 'selected' : '';
            $htmlClass .= '<option value="' . $classDet->class_id . '" ' . $isSelected . '>' . $classDet->class_name . '</option>';
        }  

        $subject_id  = $request->input('subject_id');
        $subject  = Subject::where('subject_id',$subject_id)->first();
        $output   = array(
            'board_id'       =>  $subject->board_id,
            'medium_id'      =>  $html,//$subject->medium_id,
            'class_id'       =>  $htmlClass,//$subject->class_id,
            'subject_name'   =>  $subject->subject_name,
            'subject_status'   =>  $subject->subject_status,
        );
        echo json_encode($output);
    }

    public function deleteSubjectData(Request $request){
        $subjectId = $request->subject_id;
        if (!is_null($subjectId)) {
            // $subject = Subject::where('subject_id', $subjectId)->first();
            // if ($subject) {
            //     $subject->delete();
            $subject = Subject::find($subjectId);
                if ($subject) {
                    $subject->update(['subject_status' => 'InActive']);
                echo '<div class="alert alert-success">Subject Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Subject not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Subject ID'], 400);
        }
    }
}
