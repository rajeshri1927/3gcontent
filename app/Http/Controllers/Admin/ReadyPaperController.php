<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Topic;
use App\Models\QuestionType;
use App\Models\QuestionBank;
use App\Models\McqModel;
use App\Models\McqOptions;
use App\Models\SubjectiveModel;
use App\Models\ReadyPaperStructure;
use Validator;
use DB;

class ReadyPaperController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function readyPaperStructure(Request $request){
        $this->arr_view_data['BoardList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['BoardList'] = $this->arr_view_data['BoardList'] ?? collect();

        $this->arr_view_data['QuestionTypeList'] = QuestionType::get(["qType_id", "qType_uid", "qType"]);
        $this->arr_view_data['QuestionTypeList'] = $this->arr_view_data['QuestionTypeList'] ?? collect();
        return view($this->module_view_folder.'.readyPaperStructure', $this->arr_view_data);
    }

    public function readyPaperStructureCreate(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'board_id'    => 'required',
            'medium_id'    => 'required',
            'class_id'    => 'required',
            'subject_id'    => 'required',
            'total_paper_marks' => 'required',
            'qType_id'     => 'required',
            'total_marks_as_per_question_type'    => 'required',
            'marks_per_each_question'    => 'required',
            'total_no_of_questions_to_ask'    => 'required',
            'total_no_of_questions_to_ans'    => 'required',
            'question_type_order'    => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            if($request->get('button_action') == "insert")
            {
                $paperStructure = new ReadyPaperStructure([
                        'board_id'      =>  $request->board_id,
                        'medium_id'     =>  $request->medium_id,
                        'class_id'     =>  $request->class_id,
                        'subject_id' => $request->subject_id,
                        'total_paper_marks' => $request->total_paper_marks,
                        'question_type_id' => $request->qType_id,
                        'total_marks_as_per_question_type' =>  $request->total_marks_as_per_question_type,
                        'marks_per_each_question' =>  $request->marks_per_each_question,
                        'total_no_of_questions_to_ask' => $request->total_no_of_questions_to_ask,
                        'total_no_of_questions_to_ans' => $request->total_no_of_questions_to_ans,
                        'question_type_order' => $request->question_type_order,
                        'sub_question_type_order' => $request->sub_question_type_order,
                        'child_sub_question_type_order' => $request->child_sub_question_type_order,
                        'sections' => $request->sections,
                        'sections_name' => $request->sections_name
                ]);
                $paperStructure->save();
                die;
                $success_output = '<div class="alert alert-success">Ready Paper Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $ready_paper = ReadyPaperStructure::find($request->ready_paper_id);
            
                if ($ready_paper) {
                    $ready_paper->update([
                        'board_id'      =>  $request->board_id,
                        'medium_id'     =>  $request->medium_id,
                        'class_id'      =>  $request->class_id,
                        'subject_id'    => $request->subject_id,
                        'total_paper_marks' => $request->total_paper_marks,
                        'question_type_id'  => $request->qType_id,
                        'total_marks_as_per_question_type' =>  $request->total_marks_as_per_question_type,
                        'marks_per_each_question' =>  $request->marks_per_each_question,
                        'total_no_of_questions_to_ask' => $request->total_no_of_questions_to_ask,
                        'total_no_of_questions_to_ans' => $request->total_no_of_questions_to_ans,
                        'question_type_order' => $request->question_type_order,
                        'sub_question_type_order' => $request->sub_question_type_order,
                        'child_sub_question_type_order' => $request->child_sub_question_type_order,
                        'sections' => $request->sections,
                        'sections_name' => $request->sections_name
                    ]);
            
                    $success_output = '<div class="alert alert-success">Ready Paper Data Updated</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Ready Paper not found</div>';
                }
            }
            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output
            );
            echo json_encode($output);
        }
    }

    public function getAllReadyPaperStructureData(Request $request){
        $error_array = array();
        $success_output = '';
        $readyPaperStructure = ReadyPaperStructure::select('ready_paper_structure.*', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name')
        ->join('class_details', 'class_details.class_id', '=', 'ready_paper_structure.class_id')
        ->join('board_details', 'ready_paper_structure.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'ready_paper_structure.medium_id', '=', 'medium_details.medium_id')
        ->join('subject_details', 'ready_paper_structure.subject_id', '=', 'subject_details.subject_id')
        ->orderBy('ready_paper_structure.id', 'desc')
        ->get();    
        if($readyPaperStructure){
            $success_output = '<div class="alert alert-success">Get Ready Paper Structure Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">Ready Paper Structure Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($readyPaperStructure);
    }

    public function deletReadyPaperStructure(Request $request){
        $readyPaperStructureId = $request->ready_paper_id;

        if (!is_null($readyPaperStructureId)) {
            $readyPaperStructure = ReadyPaperStructure::where('id', $readyPaperStructureId)->first();
            if ($readyPaperStructure) {
                // $readyPaperStructure->update(['question_status' => 'No']);
                $readyPaperStructure->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Ready Paper Structure not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Ready Paper Structure ID'], 400);
        }
    }

    function updateReadyPaperStructureData(Request $request)
    {
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $class_id   = $request->input('class_id');
        $subject_id   = $request->input('subject_id');
        // $questionType_id   = $request->input('question_type_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
        $questionTypeList = QuestionType::get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            if (isset($request->action) && $request->action == 'view') {
                $html .= ($mediumDet->medium_id == $medium_id) ? $mediumDet->medium : '';
            } else {
                $isSelected = ($mediumDet->medium_id == $medium_id) ? 'selected' : '';
                $html .= '<option value="' . $mediumDet->medium_id . '" ' . $isSelected . '>' . $mediumDet->medium. '</option>';
            }
        }

        $htmlClass = '';
        foreach ($classList as $classDet) {
            if (isset($request->action) && $request->action == 'view') {
                $htmlClass = $classDet->class_name;
            } else {
                $isSelected = ($classDet->class_id == $class_id) ? 'selected' : '';
                $htmlClass .= '<option value="' . $classDet->class_id . '" ' . $isSelected . '>' . $classDet->class_name . '</option>';
            }
        }

        $htmlsubject = '';
        foreach ($subjectList as $subjectDet) {
            if (isset($request->action) && $request->action == 'view') {
                $htmlsubject = $subjectDet->subject_name;
            } else {
                $isSelected = ($subjectDet->subject_id == $subject_id) ? 'selected' : '';
                $htmlsubject .= '<option value="' . $subjectDet->subject_id . '" ' . $isSelected . '>' . $subjectDet->subject_name . '</option>';
            }
        }

        /* $htmlquestiontype = '';
        foreach ($questionTypeList as $questionTypeDet) {
            if (isset($request->action) && $request->action == 'view') {
                $htmlquestiontype = $request->input('question_type_id');
            } else {
                $isSelected = ($questionTypeDet->qType === $request->input('question_type_id')) ? 'selected="selected"' : '';
                $htmlquestiontype .= '<option data-value="'.$questionTypeDet->qType.'" value="'.$questionTypeDet->qType.'" '.$isSelected.'>'.$questionTypeDet->qType.'</option>';
            }
        } */

        $readyPaperStructureId = $request->input('ready_paper_id');
        $readyPaperStructureList = ReadyPaperStructure::where('id', $readyPaperStructureId)->first();
        $htmlTotalMarks = '';
        $isSelected0 = $isSelected1 = $isSelected2 = $isSelected3 = $isSelected4 = $isSelected5 = $isSelected6 = $isSelected7 = $isSelected8 = $isSelected9 = $isSelected10 = '';
        if($readyPaperStructureList->total_paper_marks == 10){
            $isSelected0 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 20){
            $isSelected1 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 25){
            $isSelected2 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 30){
            $isSelected3 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 40){
            $isSelected4 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 50){
            $isSelected5 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 60){
            $isSelected6 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 70){
            $isSelected7 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 80){
            $isSelected8 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 90){
            $isSelected9 = 'selected="selected"';
        } elseif ($readyPaperStructureList->total_paper_marks == 100){
            $isSelected10 = 'selected="selected"';
        }

        if (isset($request->action) && $request->action == 'view') {
            $htmlTotalMarks = $readyPaperStructureList->total_paper_marks;
        } else {
            $htmlTotalMarks .= '<option value="10" '.$isSelected0.'>10</option><option value="20" '.$isSelected1.'>20</option><option value="25" '.$isSelected2.'>25</option><option value="30" '.$isSelected3.'>30</option><option value="40" '.$isSelected4.'>40</option><option value="50" '.$isSelected5.'>50</option><option value="60" '.$isSelected6.'>60</option><option value="70" '.$isSelected7.'>70</option><option value="80" '.$isSelected8.'>80</option><option value="90" '.$isSelected9.'>90</option><option value="100" '.$isSelected10.'>100</option>';
        }

        $readyPaperStructure  = ReadyPaperStructure::find($readyPaperStructureId);

        $boardDetails = Board::where('board_id',$selectedBoardId)->first();
        if (isset($request->action) && $request->action == 'view') {
            $board_id = $boardDetails->board_name;
        } else {
            $board_id = $readyPaperStructure->board_id;
        }

        if (isset($request->action) && $request->action == 'view') {
            $sub_question_type_order = ($readyPaperStructure->sub_question_type_order) ? $readyPaperStructure->sub_question_type_order : '-';
            $child_sub_question_type_order = ($readyPaperStructure->child_sub_question_type_order) ? $readyPaperStructure->child_sub_question_type_order : '-';
            $sections = ($readyPaperStructure->sections) ? $readyPaperStructure->sections : '-';
            $sections_name = ($readyPaperStructure->sections_name) ? $readyPaperStructure->sections_name : '-';
        } else {
            $sub_question_type_order = ($readyPaperStructure->sub_question_type_order) ? $readyPaperStructure->sub_question_type_order : '';
            $child_sub_question_type_order = ($readyPaperStructure->child_sub_question_type_order) ? $readyPaperStructure->child_sub_question_type_order : '';
            $sections = ($readyPaperStructure->sections) ? $readyPaperStructure->sections : '';
            $sections_name = ($readyPaperStructure->sections_name) ? $readyPaperStructure->sections_name : '';
        }

        $output   = array(
            'board_id'      =>  $board_id,
            'medium_id'     =>  $html,
            'class_id'     =>  $htmlClass,
            'subject_id' => $htmlsubject,
            'total_paper_marks' => $htmlTotalMarks,
            'question_type'  =>  $request->input('question_type_id'),
            'total_marks_as_per_question_type' => $readyPaperStructure->total_marks_as_per_question_type,
            'marks_per_each_question' => $readyPaperStructure->marks_per_each_question,
            'total_no_of_questions_to_ask' => $readyPaperStructure->total_no_of_questions_to_ask,
            'total_no_of_questions_to_ans' => $readyPaperStructure->total_no_of_questions_to_ans,
            'question_type_order' => $readyPaperStructure->question_type_order,
            'sub_question_type_order' => $sub_question_type_order,
            'child_sub_question_type_order' => $child_sub_question_type_order,
            'sections' => $sections,
            'sections_name' => $sections_name
        );
        echo json_encode($output);
    }
}