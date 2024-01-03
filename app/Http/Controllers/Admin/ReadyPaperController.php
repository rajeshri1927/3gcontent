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

        $this->arr_view_data['QuestionTypeList'] = QuestionType::get(["question_type", "question_type_id", "question_type_description"]);
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
            'total_paper_marks'    => 'required',
            'question_type_id'    => 'required',
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
                        'question_type_id' => $request->question_type_id,
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
                $success_output = '<div class="alert alert-success">Ready Paper Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $ready_paper = ReadyPaperStructure::find($request->ready_paper_id);
            
                if ($ready_paper) {
                    $ready_paper->update([
                        'board_id'      =>  $request->board_id,
                        'medium_id'     =>  $request->medium_id,
                        'class_id'     =>  $request->class_id,
                        'subject_id' => $request->subject_id,
                        'total_paper_marks' => $request->total_paper_marks,
                        'question_type_id' => $request->question_type_id,
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
        $readyPaperStructure = ReadyPaperStructure::select('ready_paper_structure.*','boards.board_name','mediums.medium_name','class.class_name','subjects.subject_name','question_types.question_type')
        ->join('class', 'class.class_id', '=', 'ready_paper_structure.class_id')
        ->join('boards', 'ready_paper_structure.board_id', '=', 'boards.board_id')
        ->join('mediums', 'ready_paper_structure.medium_id', '=', 'mediums.medium_id')
        ->join('subjects', 'ready_paper_structure.subject_id', '=', 'subjects.subject_id')
        ->join('question_types', 'ready_paper_structure.question_type_id', '=', 'question_types.question_type_id')
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
        $questionType_id   = $request->input('question_type_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
        $questionTypeList = QuestionType::where('question_type_id',$questionType_id)->get();
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

        $htmlquestiontype = '';
        foreach ($questionTypeList as $questionTypeDet) {
            $isSelected = ($questionTypeDet->question_type_id == $questionType_id) ? 'selected' : '';
            $htmlquestiontype .= '<option value="' . $questionTypeDet->question_type_id . '" ' . $isSelected . '>' . $questionTypeDet->question_type . '</option>';
        }

        $readyPaperStructureId = $request->input('ready_paper_id');
        $readyPaperStructureList = ReadyPaperStructure::where('id', $readyPaperStructureId)->first();
        $htmlTotalMarks = '';
        $isSelected0 = $isSelected1 = $isSelected2 = $isSelected3 = $isSelected4 = $isSelected5 = $isSelected6 = $isSelected7 = $isSelected8 = $isSelected9 = $isSelected10 = $isSelected11 = $isSelected12 = '';
        if($readyPaperStructureList->total_paper_marks == 8){
            $isSelected0 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 12){
            $isSelected1 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 20){
            $isSelected2 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 24){
            $isSelected3 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 25){
            $isSelected4 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 28){
            $isSelected5 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 30){
            $isSelected6 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 40){
            $isSelected7 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 50){
            $isSelected8 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 56){
            $isSelected9 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 60){
            $isSelected10 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 70){
            $isSelected11 = 'selected';
        } elseif ($readyPaperStructureList->total_paper_marks == 80){
            $isSelected12 = 'selected';
        }

        $htmlTotalMarks .= '<option value="8" '.$isSelected0.'>8</option><option value="12" '.$isSelected1.'>12</option><option value="20" '.$isSelected2.'>20</option><option value="24" '.$isSelected3.'>24</option><option value="25" '.$isSelected4.'>25</option><option value="28" '.$isSelected5.'>28</option><option value="30" '.$isSelected6.'>30</option><option value="40" '.$isSelected7.'>40</option><option value="50" '.$isSelected8.'>50</option><option value="56" '.$isSelected9.'>56</option><option value="60" '.$isSelected10.'>60</option><option value="70" '.$isSelected11.'>70</option><option value="80" '.$isSelected12.'>80</option>';

        $readyPaperStructure  = ReadyPaperStructure::find($readyPaperStructureId);
        $output   = array(
            'board_id'      =>  $readyPaperStructure->board_id,
            'medium_id'     =>  $html,
            'class_id'     =>  $htmlClass,
            'subject_id' => $htmlsubject,
            'total_paper_marks' => $htmlTotalMarks,
            'question_type'  =>  $htmlquestiontype,
            'total_marks_as_per_question_type' => $readyPaperStructure->total_marks_as_per_question_type,
            'marks_per_each_question' => $readyPaperStructure->marks_per_each_question,
            'total_no_of_questions_to_ask' => $readyPaperStructure->total_no_of_questions_to_ask,
            'total_no_of_questions_to_ans' => $readyPaperStructure->total_no_of_questions_to_ans,
            'question_type_order' => $readyPaperStructure->question_type_order,
            'sub_question_type_order' => $readyPaperStructure->sub_question_type_order,
            'child_sub_question_type_order' => $readyPaperStructure->child_sub_question_type_order,
            'sections' => $readyPaperStructure->sections,
            'sections_name' => $readyPaperStructure->sections_name
        );
        echo json_encode($output);
    }
}