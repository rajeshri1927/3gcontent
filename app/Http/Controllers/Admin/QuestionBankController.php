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
use DataTables;
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

        $this->arr_view_data['QuestionTypeList'] = QuestionType::get(["qType_id","qType", "qType_status"]);
        $this->arr_view_data['QuestionTypeList'] = $this->arr_view_data['QuestionTypeList'] ?? collect();
        $count = QuestionBank::count();
        $this->arr_view_data['question_bank_count'] = $count;
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

    // public function getQuestionBankData(Request $request){
    //     $error_array    = array();
    //     $success_output = '';

    //     $board     = $request->board;
    //     $medium    = $request->medium;
    //     $classname = $request->classname;
    //     $subject   = $request->subject;
    //     $chapter   = $request->chapter;
    //     //\DB::enableQueryLog();
    //     $question = QuestionBank::select('question_list.*','topic_details.topic_name','question_list.created_on','board_details.board_name','medium_details.medium','class_details.class_name','subject_details.subject_name','chapter_details.chapter_name')
    //     ->join('class_details', 'class_details.class_id', '=', 'question_list.class_id')
    //     ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
    //     ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
    //     ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
    //     ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
    //     ->join('topic_details', 'question_list.topic_id', '=', 'topic_details.topic_id');
    //     //->where('question_list.question_type', '=', 'MCQ')
    //     if($board) {
    //         $question->where('question_list.board_id', $board);
    //     }
    //     if($medium){
    //         $question->where('question_list.medium_id', $medium);
    //     }
    //     if($classname){
    //         $question->where('question_list.class_id', $classname);
    //     }
    //     if($subject){
    //         $question->where('question_list.subject_id', $subject);
    //     }
    //     if($chapter){
    //         $question->where('question_list.chapter_id', $chapter);
    //     }
        
    //     $result = $question->orderBy('question_list.question_id', 'DESC')
    //         ->limit(500)
    //         ->get();
        
    //     //dd(\DB::getQueryLog());
    //     if($result){
    //         $success_output = '<div class="alert alert-success">Get Question Data !!!</div>';
    //     }else{
    //         $success_output = '<div class="alert alert-danger">Question Data Not Available !!!</div>';
    //     }
    //     $output = array(
    //         'error'     =>  $error_array,
    //         'success'   =>  $success_output
    //     );
    //     echo json_encode($result);
    // }
    
    public function getQuestionBankData(Request $request){
        $build_result = array();
        $board     = $request->board;
        $medium    = $request->medium;
        $classname = $request->classname;
        $subject   = $request->subject;
        $chapter   = $request->chapter;
        //\DB::enableQueryLog();
        $question = QuestionBank::select('question_list.*','topic_details.topic_name','board_details.board_name','medium_details.medium','class_details.class_name','subject_details.subject_name','chapter_details.chapter_name')
        ->join('class_details', 'class_details.class_id', '=', 'question_list.class_id')
        ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
        ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
        ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
        ->join('topic_details', 'question_list.topic_id', '=', 'topic_details.topic_id');
        if($board) {
            $question->where('question_list.board_id', $board);
        }
        if($medium){
            $question->where('question_list.medium_id', $medium);
        }
        if($classname){
            $question->where('question_list.class_id', $classname);
        }
        if($subject){
            $question->where('question_list.subject_id', $subject);
        }
        if($chapter){
            $question->where('question_list.chapter_id', $chapter);
        }
        
        $result = $question->orderBy('question_list.question_id', 'DESC')
            ->limit(500)
            ->latest();
        
        $json_result = DataTables::of($result)
        ->addColumn('built_action_btns', function ($data) {
            $updateButton = '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->question_id.'" data-toggle="modal" title="Update Medium Details"><i class="fas fa-edit"></i></button>';
            $deleteButton = '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->question_id.'" data-toggle="modal" name="button" title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
            return '<input type="checkbox" class="selectCheckbox" data-medium-id="'.$data->question_id.'">' . $updateButton . $deleteButton;
        })->make(true);
		$build_result = $json_result->getData();

        if (isset($build_result->data) && sizeof($build_result->data) > 0) {
            $i = 0;
            foreach ($build_result->data as $key => $data) {
                $i = $i + 1;
                $decodedHtml  = html_entity_decode($data->question); 
                $strippedHtml = strip_tags($decodedHtml);
                $questionType = html_entity_decode($data->question_type); 
                $strippedQuestionTypeHtml = strip_tags($questionType);
                $delete = '<input type="checkbox" class="selectmediumCheckbox" data-medium-id="'.$data->question_id.'">';
                $build_result->data[$key]->delete = $delete;
                // $build_result->data[$key]->question_id  = $data->question_id;
                $build_result->data[$key]->board_name = $data->board_name;
                $build_result->data[$key]->medium = $data->medium;
                $build_result->data[$key]->class_name = $data->class_name;
                $build_result->data[$key]->subject_name = $data->subject_name;
                $build_result->data[$key]->chapter_name = $data->chapter_name;
                $build_result->data[$key]->marks = $data->marks;
                $build_result->data[$key]->question_type = $strippedQuestionTypeHtml;
                $build_result->data[$key]->question = $strippedHtml;
                $build_result->data[$key]->created_at = date("d M Y", strtotime($data->created_on));
                $action = '<button class="btn btn-sm btn-secondary mt-1 view" type="button" data-class-id ="'.$data->class_id.'" data-medium-id ="'.$data->medium_id.'" data-board-id ="'.$data->board_id.'" data-id="'.$data->question_id.'" data-subject-id="'.$data->subject_id.'" data-topic-id="'.$data->topic_id.'" data-chapter-id="'.$data->chapter_id.'" data-questionType="'.$data->question_type.'" data-toggle="modal" title="View Question Bank Details"><i class="fas fa-eye"></i></button>
                <button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->question_id.'"  data-class-id ="'.$data->class_id.'" data-medium-id ="'.$data->medium_id.'" data-board-id ="'.$data->board_id.'" data-id="'.$data->question_id.'" data-subject-id="'.$data->subject_id.'" data-topic-id="'.$data->topic_id.'" data-chapter-id="'.$data->chapter_id.'" data-questionType="'.$data->question_type.'"  data-toggle="modal"  title="Update Topic Details"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->question_id.'"  data-toggle="modal" name="button" title="Delete Topic Details"><i class="fas fa-trash-alt"></i></button>';
				$build_result->data[$key]->built_action_btns = $action;
            }
           // dd($build_result);
            return response()->json($build_result);
        } else {
            return response()->json($build_result);
        }
 
    }

    public function addQuestionBank(Request $request){
        $user = Auth::user();
        // echo "<pre>";print_r($request->all());die;
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
        $class_id     = $request->input('class_id');
        $subject_id   = $request->input('subject_id');
        $chapter_id   = $request->input('chapter_id');
        $topic_id   = $request->input('topic_id');
        $questionType_id   = $request->input('question_type');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
        $chapterList = Chapter::where('chapter_id',$chapter_id)->get();
        $topicList = Topic::where('topic_id',$topic_id)->get();
        $questionTypeList = QuestionType::where('qType',$questionType_id)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            if (isset($request->action) && $request->action == 'view') {
                $html .= ($mediumDet->medium_id == $medium_id) ? $mediumDet->medium : '';
            }else{
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
        
        $htmlchapter = '';
        foreach ($chapterList as $chapterDet) {
            if (isset($request->action) && $request->action == 'view') {
                $htmlchapter = $chapterDet->chapter_name;
            }else{
                $isSelected = ($chapterDet->chapter_id == $chapter_id) ? 'selected' : '';
                $htmlchapter .= '<option value="' . $chapterDet->chapter_id . '" ' . $isSelected . '>' . $chapterDet->chapter_name . '</option>';
            }
        }

        $htmltopic = (isset($request->action) && $request->action == 'view') ? 'NA' : '';
        if(!empty($topicList)){
            foreach ($topicList as $topicDet) {
                if (isset($request->action) && $request->action == 'view') {
                    $htmltopic = $topicDet->topic_name;
                }else{
                    $isSelected = ($topicDet->topic_id == $topic_id) ? 'selected' : '';
                    $htmltopic .= '<option value="' . $topicDet->topic_id . '" ' . $isSelected . '>' . $topicDet->topic_name . '</option>';
                }
            }
        }

        $htmlquestiontype = '';
        foreach ($questionTypeList as $questionTypeDet) {
            if (isset($request->action) && $request->action == 'view') {
                $htmlquestiontype = $questionTypeDet->qType;
            }else{
                $isSelected = ($questionTypeDet->qType == $questionType_id) ? 'selected' : '';
                $htmlquestiontype .= '<option value="' . $questionTypeDet->questionType_id . '" ' . $isSelected . '>' . $questionTypeDet->qType . '</option>';
            }
        }

        $question_bank_id = $request->input('question_id');
        $questionBank  = QuestionBank::where('question_id',$question_bank_id)->first();  
        $created_on   = date('d M Y ',strtotime($questionBank->created_on));
        $boardDetails = Board::where('board_id',$selectedBoardId)->first();
        //dd($questionBank->board_id);
        $htmlBoards   = '';
        //foreach ($boardDetails as $boardDet) {
            //dd($boardDet);
            // if (isset($request->action) && $request->action == 'view') {
            //     $htmlBoards = $boardDetails->board_name;
            // }else{
            //     $isSelected = ($boardDetails->board_id == $questionBank->board_id) ? 'selected' : '';
            //     $htmlBoards .= '<option value="' . $boardDetails->board_id . '" ' . $isSelected . '>' . $boardDetails->board_name . '</option>';
            // }
        //}
        if (isset($request->action) && $request->action == 'view') {
            $board_id = $boardDetails->board_name;
        } else {
            $board_id = $questionBank->board_id;
        }

        $soluation = (!empty($questionBank->solution)) ? $questionBank->solution : 'NA';
        if($htmlquestiontype=='True or False'){
            $check1 = ($questionBank->is_true=="Yes") ? 'checked' : '';
            $check2 = ($questionBank->is_true=="No") ? 'checked' : '';

            // $soluation = $questionBank->is_true;
            $soluation = '<div class="form-group">                        
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="edittrueFalse" value="Yes" '.$check1.' readonly></span>
                      </div>
                      <input type="text" class="form-control" name="true" value="True" readonly>
                    </div>
                  </div>
                  <div class="form-group">                        
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="edittrueFalse" value="No" '.$check2.' readonly></span>
                      </div>
                      <input type="text" class="form-control" name="False" value="False" readonly>
                    </div>
                  </div>'; 
        }elseif ($htmlquestiontype == 'MCQ') {
            $result = \DB::table('mcq_option_list')->where('question_id', $question_bank_id)->get();
            // dd($result);
            $i = 1;
            foreach ($result as $key => $optvalue) {
                $soluation = '<div class="input-group mt-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="editqOption" value="option' . $i . '" ' . (($optvalue->is_answer == "Yes") ? "checked" : "") . '></span>
                    </div>
                    <input type="text" class="form-control" name="option' . $i . '" id="option' . $i . '" value="' . $optvalue->option_detail . '" readonly>
                </div>';
                $i++;
            }
        } else {
            $soluation = $questionBank->solution;
        }                         
        $output   = array(
            'board_id'   =>  $board_id,
            'medium_id'  =>  $html,
            'class_id'   =>  $htmlClass,
            'subject_id' =>  $htmlsubject,
            'chapter_id' =>  $htmlchapter,
            'topic_id'   =>  $htmltopic,
            'marks'      =>  $questionBank->marks,
            'question_type'  => $htmlquestiontype,
            'level'      => $questionBank->level,
            'question'   => $questionBank->question,
            'solution'   => $soluation,
            'question_status' => $questionBank->question_status,
            'created_on' => $created_on,
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

    public function deleteMultipleQuestionData(Request $request)
    {
        $ids = $request->input('question_ids');
        if (is_string($ids) && !empty($ids)) {
            // Convert comma-separated string to an array
            $questionIdsArray = explode(',', $ids);
            // Remove any empty values
            $questionIdsArray = array_filter($questionIdsArray);
            if (!empty($questionIdsArray)) {
                // Perform the delete operation based on the provided IDs
                QuestionBank::whereIn('question_id', $questionIdsArray)->delete();
                echo '<div class="alert alert-success">All Questions Deleted.</div>';
            } else {
                return response()->json(['error' => 'Invalid or empty Question_ids provided'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid or empty Question_ids provided'], 400);
        }
    }

    // public function getQuestionDetailsAsPerFilterVariable(Request $request)
    // {
    //     $board     = $request->board;
    //     $medium    = $request->medium;
    //     $classname = $request->classname;
    //     $subject   = $request->subject;
    //     $chapter   = $request->chapter;
    //     $data = QuestionBank::select(
    //             'question_list.*',
    //             'board_details.board_name',
    //             'class_details.class_name',
    //             'subject_details.subject_name',
    //             'chapter_details.chapter_no',
    //             'chapter_details.chapter_name'
    //         )
    //         ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
    //         ->join('class_details', 'question_list.class_id', '=', 'class_details.class_id')
    //         ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
    //         ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
    //         ->where('question_list.board_id', $board)
    //         ->where('question_list.medium_id', $medium)
    //         ->where('question_list.class_id', $classname)
    //         ->where('question_list.subject_id', $subject)
    //         ->where('question_list.chapter_id', $chapter)
    //         ->orderBy('question_list.created_on', 'DESC')
    //         ->get();
    //     return $data->isEmpty() ? false : $data->toArray();
    // }

}