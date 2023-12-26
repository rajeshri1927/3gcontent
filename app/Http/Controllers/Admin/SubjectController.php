<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;
use Validator;

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
                    'board_id'      =>  $request->get('board_id'),
                    'medium_id'     =>  $request->get('medium_id'),
                    'class_id'      => $request->get('class_id'),
                    'subject_name'  => $request->get('subject_name'),
                    'subject_description' => $request->get('subject_description'),
                    'subject_status' => $request->get('subject_status')
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
                        'subject_description' => $request->get('subject_description'),
                        'subject_status' => $request->get('subject_status')
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
            'subjects.*',
            'class.class_name',
            'class.class_id',
            'boards.board_id',
            'boards.board_name',
            'mediums.medium_name',
            'mediums.medium_id',
        )
        ->leftjoin('class', 'class.class_id', '=', 'subjects.class_id')
        ->leftjoin('mediums', 'subjects.medium_id', '=', 'mediums.medium_id')
        ->leftjoin('boards', 'class.board_id', '=', 'boards.board_id')
        ->orderBy('subjects.subject_id', 'asc')
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
            $html .= '<option value="' . $mediumDet->medium_id . '" ' . $isSelected . '>' . $mediumDet->medium_name . '</option>';
        }  

        $htmlClass = '';
        foreach ($classList as $classDet) {
            $isSelected = ($classDet->class_id == $class_id) ? 'selected' : '';
            $htmlClass .= '<option value="' . $classDet->class_id . '" ' . $isSelected . '>' . $classDet->class_name . '</option>';
        }  

        $subject_id  = $request->input('subject_id');
        $subject  = Subject::find($subject_id);
        $output   = array(
            'board_id'       =>  $subject->board_id,
            'medium_id'      =>  $html,//$subject->medium_id,
            'class_id'       =>  $htmlClass,//$subject->class_id,
            'subject_name'   =>  $subject->subject_name,
            'subject_description' =>  $subject->subject_description,
            'subject_status'   =>  $subject->subject_status,
        );
        echo json_encode($output);
    }

    public function deleteSubjectData(Request $request){
        $subjectId = $request->subject_id;
        if (!is_null($subjectId)) {
            $subject = Subject::where('subject_id', $subjectId)->first();

            if ($subject) {
                $subject->delete();
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
