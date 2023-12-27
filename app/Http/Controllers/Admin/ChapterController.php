<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\Chapter;

use Validator;

class ChapterController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(){
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.chapter', $this->arr_view_data,$data);
    }

    public function getSubject(Request $request){
        $subjectList = Subject::where('class_id',$request->class_id)->get();
        $html = '';
        foreach ($subjectList as $subjectDet) {
            $html .= '<option value="' . $subjectDet->subject_id . '">' . $subjectDet->subject_name . '</option>';
        }        
        echo $html;
    }

    public function addChapter(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'chapter_name'  => 'required'
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
                $chapter = new Chapter([
                    'board_id'      => $request->get('board_id'),
                    'medium_id'     => $request->get('medium_id'),
                    'class_id'      => $request->get('class_id'),
                    'subject_id'    => $request->get('subject_id'),
                    'chapter_no'    => $request->get('chapter_no'),
                    'chapter_name'  => $request->get('chapter_name'),
                    'chapter_description' => $request->get('chapter_description'),
                    'chapter_status' => $request->get('chapter_status'),
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $chapter->save();
                $success_output = '<div class="alert alert-success">Chapter Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $chapter = Chapter::find($request->get('chapter_id'));
                if ($chapter) {
                    $chapter->update([
                        'board_id'      =>  $request->get('board_id'),
                        'medium_id'     =>  $request->get('medium_id'),
                        'class_id'      => $request->get('class_id'),
                        'subject_id'    => $request->get('subject_id'),
                        'chapter_no'    => $request->get('chapter_no'),
                        'chapter_name' => $request->get('chapter_name'),
                        'chapter_description' => $request->get('chapter_description'),
                        'chapter_status' => $request->get('chapter_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
                    //$id = $chapter->chapter_id;
                    $success_output = '<div class="alert alert-success">Chapter Data Updated !!!</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Chapter not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function getChapterAllData(){
        $error_array = array();
        $success_output = '';
        $chapters = Chapter::select(
            'chapters.*',
            'subjects.subject_id',
            'subjects.subject_name',
            'class.class_id',
            'class.class_name',
            'boards.board_id',
            'boards.board_name',
            'mediums.medium_id',
            'mediums.medium_name'
        )
        ->leftJoin('subjects', 'chapters.subject_id', '=', 'subjects.subject_id')
        ->leftJoin('class', 'subjects.class_id', '=', 'class.class_id')
        ->leftJoin('mediums', 'subjects.medium_id', '=', 'mediums.medium_id')
        ->leftJoin('boards', 'class.board_id', '=', 'boards.board_id')
        ->orderBy('subjects.subject_id', 'asc')
        ->get();    
        if($chapters){
            $success_output = '<div class="alert alert-success">Get Chapter Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">Chapter Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($chapters);

    }

    public function updateGetChaptertData(Request $request){
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $class_id   = $request->input('class_id');
        $subject_id   = $request->input('subject_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
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

        $htmlsubject = '';
        foreach ($subjectList as $subjectDet) {
            $isSelected = ($subjectDet->subject_id == $subject_id) ? 'selected' : '';
            $htmlsubject .= '<option value="' . $subjectDet->subject_id . '" ' . $isSelected . '>' . $subjectDet->subject_name . '</option>';
        }  

        $chapter_id = $request->input('chapter_id');
        $chapter  = Chapter::find($chapter_id);
        $output   = array(
            'board_id'       =>  $chapter->board_id,
            'medium_id'      =>  $html,//$subject->medium_id,
            'class_id'       =>  $htmlClass,//$subject->class_id,
            'subject_id'     =>  $htmlsubject,//$subject->subject_id,
            'chapter_no'     =>  $chapter->chapter_no,
            'chapter_name'   =>  $chapter->chapter_name,
            'chapter_description' =>  $chapter->chapter_description,
            'chapter_status'   =>  $chapter->chapter_status,
        );
        echo json_encode($output);
    }

    public function deleteChapterData(Request $request){
        $chapterId = $request->chapter_id;
        if (!is_null($chapterId)) {
            $chapter = Chapter::where('chapter_id', $chapterId)->first();

            if ($chapter) {
                $chapter->delete();
                echo '<div class="alert alert-success">Chapter Deleted Successfully!!</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Chapter not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Chapter ID'], 400);
        }
    }
}
