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
        ->limit(500)
        ->get();
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
                $questionBank = new QuestionBank([
                    'question_id'   => strtoupper(substr(uniqid("mcq_qst"."_".md5(uniqid("mcq_qust", true))), 0,18)),
                    'board_id'      => $request->board_id,
                    'medium_id'     => $request->medium_id,
                    'class_id'      => $request->class_id,
                    'subject_id'    => $request->subject_id,
                    'chapter_id'    => $request->chapter_id,
                    'topic_id'      => $request->topic_id,
                    'marks'         => $request->marks,
                    'level'         => $request->dificultyLevel,
                    'question_type' => $request->question_type_id,
                    'question_status'=> $request->question_status,
                    'question'      => $request->question,
                    'solution'      => $request->solution,
                    'created_by'    => $user->emp_name,
                    'creation_ip'   => $_SERVER['REMOTE_ADDR']
                ]);
                if ($request->question_type_id == 'MCQ') {
                    $ans=$request['qOption'];  
                    $questionBank->save();
                    $lastInsertedId = $questionBank->question_id;
                        if ($questionBank==true) {
                            for ($i=1; $i<=4; $i++) {
                                $option_id= strtoupper(substr(uniqid("mcq_qst" . "_" . md5(uniqid("mcq_qust", true))), 0, 18));
                                $option=(isset($request['option'.$i]) && $request['option'.$i]!="")?$request['option'.$i]:"";
                                if ($ans=="option".$i) {
                                    $result = \DB::table('mcq_option_list')->insert([
                                        'option_id'   => $option_id,
                                        'question_id' => $lastInsertedId,
                                        'option_detail'=> $option,
                                        'option_sequence' => $i,
                                        'is_answer'     => 'Yes',
                                        'created_by'    => $user->emp_name,
                                        'creation_ip'   => $_SERVER['REMOTE_ADDR']
                                    ]);
                                }
                            }

                        }
                    }elseif($request->question_type_id == 'True or False'){
                        $ans     = $request['trueFalse'];
                        $trueFalseId = strtoupper(substr(uniqid("tf_qst"."_".md5(uniqid("tf_qst", true))), 0,18));
                        $tfquestion  = addslashes(trim($request['tfQuestion']));
                        $tfQStatus   =  new QuestionBank([
                            'question_id' => $trueFalseId,
                            'board_id'      => $request->board_id,
                            'medium_id'     => $request->medium_id,
                            'class_id'      => $request->class_id,
                            'subject_id'    => $request->subject_id,
                            'chapter_id'    => $request->chapter_id,
                            'topic_id'      => $request->topic_id,
                            'marks'         => $request->marks,
                            'question_type' => 'True or False',
                            'level'         => $request->dificultyLevel,
                            'question_status'=> $request->question_status,
                            'question'      => $tfquestion,
                            'is_true'       => $ans,
                            'created_by'    => $user->emp_name,
                            'creation_ip'   => $_SERVER['REMOTE_ADDR']
                        ]);
                        $tfQStatus->save();
                    }else{
                        $qId         = strtoupper(substr(uniqid("qst"."_".md5(uniqid("qst", true))), 0,18));
                        $question    = addslashes(trim($request['question']));
                        $solution    = addslashes(trim($request['solution']));
                        $aiosQStatus =  new QuestionBank([ 
                            'question_id' => $qId,
                            'board_id'      => $request->board_id,
                            'medium_id'     => $request->medium_id,
                            'class_id'      => $request->class_id,
                            'subject_id'    => $request->subject_id,
                            'chapter_id'    => $request->chapter_id,
                            'topic_id'      => $request->topic_id,
                            'marks'         => $request->marks,
                            'question_type' => $request->question_type_id,
                            'level'         => $request->dificultyLevel,
                            'question_status'=> $request->question_status,
                            'question'      => $question,
                            'solution'      => $solution,
                            'is_true'       => $ans,
                            'created_by'    => $user->emp_name,
                            'creation_ip'   => $_SERVER['REMOTE_ADDR']
                        ]);
                        $aiosQStatus->save();
                    }
                    $success_output = '<div class="alert alert-success">Question Bank Data Inserted</div>';
                //}
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
        $questionTypeList = QuestionType::where('qType_id',$questionType_id)->get();
        dd($questionTypeList);
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
            dd($questionTypeDet);
            $isSelected = ($questionTypeDet->question_id == $question_type_id) ? 'selected' : '';
            $htmlquestiontype .= '<option value="' . $questionTypeDet->question_type_id . '" ' . $isSelected . '>' . $questionTypeDet->question_type . '</option>';
        }

        $question_bank_id = $request->input('question_id');
        $questionBank  = QuestionBank::where('question_id',$question_bank_id)->first();  
        $output   = array(
            'board_id'   =>  $questionBank->board_id,
            'medium_id'  =>  $html,
            'class_id'   =>  $htmlClass,
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
    
    function deleteQuestionBankData(Request $request)
    {
        $questionBankID = $request->question_id;

        if (!is_null($questionBankID)) {
            $questionBank = QuestionBank::where('question_id', $questionBankID)->first();
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