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
use App\Models\McqOptions;
use Validator;
use DB;

class QuestionBankController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {     
        $this->arr_view_data['BoardList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['BoardList'] = $this->arr_view_data['BoardList'] ?? collect();

        $this->arr_view_data['QuestionTypeList'] = QuestionType::get(["qType", "qType_status"]);
        $this->arr_view_data['QuestionTypeList'] = $this->arr_view_data['QuestionTypeList'] ?? collect();
        return view($this->module_view_folder.'.questionbank', $this->arr_view_data);
    }
    
    public function getTopicAjax(Request $request){
        $topicList = Topic::where('chapter_id',$request->chapter_id)->get();
        $html = '';
        foreach ($topicList as $topicDet) {
            $html .= '<option value="' . $topicDet->topic_id . '">' . $topicDet->topic_name . '</option>';
        }        
        echo $html;
    }

    public function getQuestionBankData(){
        $error_array = array();
        $success_output = '';
        $question = QuestionBank::select('question_list.*','topic_details.topic_name','question_list.created_on','board_details.board_name','medium_details.medium','class_details.class_name','subject_details.subject_name','chapter_details.chapter_name')
        ->join('class_details', 'class_details.class_id', '=', 'question_list.class_id')
        ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
        ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
        ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
        ->join('topic_details', 'question_list.topic_id', '=', 'topic_details.topic_id')
        ->orderBy('question_list.question_id', 'DESC')
        ->take(500)
        ->get();
        //dd($question);
        if($question){
            $success_output = '<div class="alert alert-success">Get Question Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">Question Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($question);
    }

    public function addQuestionBank(Request $request){
        $user = Auth::user();
        echo "<pre>";print_r($request->all());die;
        $validation = Validator::make($request->all(), [
            'marks'    => 'required'
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
                $mcqAns = '';
                if($request->question_type_id == 'MCQ'){
                    $qId = strtoupper(substr(uniqid("mcq_qst"."_".md5(uniqid("mcq_qust", true))), 0,18));
                    $question = addslashes(trim($request->question));
                    $solution = $mcqAns = $request->qOption;
                } elseif ($questionType=="True or False") {
                    $qId = strtoupper(substr(uniqid("tf_qst"."_".md5(uniqid("tf_qst", true))), 0,18));
                    $question = addslashes(trim($request->question));
                } else {
                    $qId = strtoupper(substr(uniqid("qst"."_".md5(uniqid("qst", true))), 0,18));
                    $question = addslashes(trim($request->question));
                    $solution = addslashes(trim($request->solution));
                }
                $questionBank = new QuestionBank([
                    'question_id'      =>  $qId,
                    'board_id'      =>  $request->board_id,
                    'medium_id'     =>  $request->medium_id,
                    'class_id'     =>  $request->class_id,
                    'subject_id' => $request->subject_id,
                    'chapter_id' => $request->chapter_id,
                    'topic_id' => $request->topic_id,
                    'marks'    =>  $request->marks,
                    'question_type_id' =>  $request->question_type_id,
                    'level' => $request->dificultyLevel,
                    'question_status' => $request->question_status,
                    'question' => $question,
                    'solution' => $solution,
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $questionBank->save();
                $Qb = QuestionBank::where('question_bank_id',$questionBank->getKey())->update(array('question_bank_id' => 'QST'));
                $success_output = '<div class="alert alert-success">Question Bank Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $question_bank = QuestionBank::find($request->question_bank_id);
            
                if ($question_bank) {
                    $question_bank->update([
                        'board_id'      =>  $request->board_id,
                        'medium_id'     =>  $request->medium_id,
                        'class_id'     =>  $request->class_id,
                        'subject_id' => $request->subject_id,
                        'chapter_id' => $request->chapter_id,
                        'topic_id' => $request->topic_id,
                        'marks'    =>  $request->marks,
                        'question_type_id' =>  $request->question_type_id,
                        'level' => $request->dificultyLevel,
                        'question_status' => $request->question_status,
                        'question' => $request->question,
                        'solution' => $request->solution,
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
            
                    $success_output = '<div class="alert alert-success">Question Type Data Updated</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Question Type not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function updateQuestionBankData(Request $request)
    {
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $class_id   = $request->input('class_id');
        $subject_id   = $request->input('subject_id');
        $chapter_id   = $request->input('chapter_id');
        $topic_id   = $request->input('topic_id');
        $questionType_id   = $request->input('questionType_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
        $chapterList = Chapter::where('chapter_id',$chapter_id)->get();
        $topicList = Topic::where('topic_id',$topic_id)->get();
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
        
        $htmlchapter = '';
        foreach ($chapterList as $chapterDet) {
            $isSelected = ($chapterDet->chapter_id == $chapter_id) ? 'selected' : '';
            $htmlchapter .= '<option value="' . $chapterDet->chapter_id . '" ' . $isSelected . '>' . $chapterDet->chapter_name . '</option>';
        }

        $htmltopic = '';
        foreach ($topicList as $topicDet) {
            $isSelected = ($topicDet->topic_id == $topic_id) ? 'selected' : '';
            $htmltopic .= '<option value="' . $topicDet->topic_id . '" ' . $isSelected . '>' . $topicDet->topic_name . '</option>';
        }

        $htmlquestiontype = '';
        foreach ($questionTypeList as $questionTypeDet) {
            $isSelected = ($questionTypeDet->question_type_id == $question_type_id) ? 'selected' : '';
            $htmlquestiontype .= '<option value="' . $questionTypeDet->question_type_id . '" ' . $isSelected . '>' . $questionTypeDet->question_type . '</option>';
        }

        $question_bank_id = $request->input('question_bank_id');
        $questionBank  = QuestionBank::find($question_bank_id);
        $output   = array(
            'board_id'      =>  $questionBank->board_id,
            'medium_id'     =>  $html,
            'class_id'     =>  $htmlClass,
            'subject_id' => $htmlsubject,
            'chapter_id' => $htmlchapter,
            'topic_id' => $htmltopic,
            'marks'    =>  $questionBank->marks,
            'question_type'  =>  $htmlquestiontype,
            'level' => $questionBank->level,
            'question_status' => $questionBank->question_status
        );
        echo json_encode($output);
    }
    
    public function deleteQuestionBankData(Request $request)
    {
        $questionBankID = $request->question_id;

        if (!is_null($questionBankID)) {
            $questionBank = QuestionBank::where('question_bank_id', $questionBankID)->first();
            if ($questionBank) {
                // $questionBank->update(['question_status' => 'No']);
                $questionBank->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Question Bank not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Question Bank ID'], 400);
        }
    }

}
