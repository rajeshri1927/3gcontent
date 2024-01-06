<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Medium;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Topic;
use App\Models\QuestionType;
use Validator;

class QuestionTypeController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {     
        // $data['BoardList'] = Board::get(["board_name", "board_id"]);
        // $data['BoardList'] = $data['BoardList'] ?? collect();
        // $data['MediumList']  = Medium::get(["medium_name", "medium_id"]);
        // $data['MediumList']  = $data['MediumList'] ?? collect();
        // $data['ClassList']   = Standard::get(["class_name", "class_id"]);
        // $data['ClassList']   = $data['ClassList'] ?? collect();
        // $data['SubjectList'] = Subject::get(["subject_name", "subject_id"]);
        // $data['SubjectList'] = $data['SubjectList'] ?? collect();
        // $data['ChapterList'] = Chapter::get(["chapter_name", "chapter_id"]);
        // $data['ChapterList'] = $data['ChapterList'] ?? collect();
        // $data['TopicList'] = Topic::get(["topic_name", "topic_id"]);
        // $data['TopicList'] = $data['TopicList'] ?? collect();
        // $questionType = QuestionType::select('question_types.question_type_id','question_types.class_id','question_types.board_id','question_types.medium_id','question_types.question_type','question_types.created_at','boards.board_name','mediums.medium_name','class.class_name','subjects.subject_name','chapters.chapter_name',
        // 'topics.topic_name')
        // ->join('class', 'class.class_id', '=', 'question_types.class_id')
        // ->join('boards', 'question_types.board_id', '=', 'boards.board_id')
        // ->join('mediums', 'question_types.medium_id', '=', 'mediums.medium_id')
        // ->join('subjects', 'question_types.subject_id', '=', 'subjects.subject_id')
        // ->join('chapters', 'question_types.chapter_id', '=', 'chapters.chapter_id')
        // ->join('topics', 'question_types.topic_id', '=', 'topics.topic_id')
        // ->orderBy('question_types.question_type_id', 'asc')
        // ->toSql();
        // $data['questionTypeList'] = $questionType;
        $count = QuestionType::count();
        $this->arr_view_data['question_type_count'] = $count;
        return view($this->module_view_folder.'.questiontype', $this->arr_view_data);
    }

    public function getTopicAjax(Request $request){
        $topicList = Topic::where('chapter_id',$request->chapter_id)->get();
        $html = '';
        foreach ($topicList as $topicDet) {
            //dd($topicDet);
            $html .= '<option value="' . $topicDet->topic_id . '">' . $topicDet->topic_name . '</option>';
        }  
        echo $html;
    }
    // public function getQuestionTypeData(){
    //     $questionType = QuestionType::select('*')->where('question_type_status','Yes')->orderBy('question_type_id','asc')->get();
    //     echo json_encode($questionType);
    // }
    
    // public function getQuestionTypeAllData(){
    //     $questionType = QuestionType::select('question_types.question_type_id',
    //     'question_types.board_id','question_types.medium_id','question_types.class_id',
    //     'question_types.subject_id','question_types.chapter_id','question_types.topic_id',
    //     'question_types.question_type','question_types.question_type_description','question_types.question_type_status',
    //     'question_types.created_at','boards.board_name','mediums.medium_name','class.class_name','chapters.chapter_name',
    //     'subjects.subject_name','topics.topic_name','topics.topic_name')
    //     ->join('class', 'class.class_id', '=', 'question_types.class_id')
    //     ->join('boards', 'question_types.board_id', '=', 'boards.board_id')
    //     ->join('mediums', 'question_types.medium_id', '=', 'mediums.medium_id')
    //     ->join('chapters', 'question_types.chapter_id', '=', 'chapters.chapter_id')
    //     ->join('subjects', 'question_types.subject_id', '=', 'subjects.subject_id')
    //     ->join('topics', 'question_types.topic_id', '=', 'topics.topic_id')
    //     ->get();
    //     echo json_encode($questionType);
    // }
    
    public function getQuestionTypeAllData()
    {
        $questionType = QuestionType::select('*')->orderBy('qType_id', 'ASC')->get();
        // $questionType = QuestionType::select(
        //     'question_types.question_type_id',
        //     'question_types.board_id',
        //     'question_types.medium_id',
        //     'question_types.class_id',
        //     'question_types.subject_id',
        //     'question_types.chapter_id',
        //     'question_types.topic_id',
        //     'question_types.question_type',
        //     'question_types.question_type_description',
        //     'question_types.question_type_status',
        //     'question_types.created_at',
        //     'boards.board_name',
        //     'mediums.medium_name',
        //     'class.class_name',
        //     'chapters.chapter_name',
        //     'subjects.subject_name',
        //     'topics.topic_name'
        // )
        //     ->join('class', 'class.class_id', '=', 'question_types.class_id')
        //     ->join('boards', 'question_types.board_id', '=', 'boards.board_id')
        //     ->join('mediums', 'question_types.medium_id', '=', 'mediums.medium_id')
        //     ->join('chapters', 'question_types.chapter_id', '=', 'chapters.chapter_id')
        //     ->join('subjects', 'question_types.subject_id', '=', 'subjects.subject_id')
        //     ->join('topics', 'question_types.topic_id', '=', 'topics.topic_id')
        //     ->get();

        return response()->json($questionType);
    }

    public function addQuestionType(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'qType'    => 'required'
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
                $questionType = new QuestionType([
                    'qType_uid'  => strtoupper(substr(uniqid("qType"."_".md5(uniqid("qType", true))), 0,15)),
                    // 'board_id'         =>  $request->get('board_id'),
                    // 'medium_id'        =>  $request->get('medium_id'),
                    // 'class_id'         =>  $request->get('class_id'),
                    // 'subject_id'       =>  $request->get('subject_id'),
                    // 'chapter_id'       =>  $request->get('chapter_id'),
                    // 'topic_id'         =>  $request->get('topic_id'),
                    'qType'      =>  $request->get('qType'),
                    // 'question_type_description' =>  $request->get('question_type_description'),
                    'qType_status' => $request->get('qType_status'),
                    'created_by' => $user->emp_name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $questionType->save();
                $success_output = '<div class="alert alert-success">Question Type Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $question_type = QuestionType::find($request->get('qType_id'));
                if ($question_type) {
                    $question_type->update([
                        // 'board_id'         =>  $request->get('board_id'),
                        // 'medium_id'        =>  $request->get('medium_id'),
                        // 'class_id'         =>  $request->get('class_id'),
                        // 'subject_id'       =>  $request->get('subject_id'),
                        // 'chapter_id'       =>  $request->get('chapter_id'),
                        // 'topic_id'         =>  $request->get('topic_id'),
                        // 'question_type'    =>  $request->get('question_type'),
                        // 'question_type_description' =>  $request->get('question_type_description'),
                        // 'question_type_status' => $request->get('question_type_status'),
                        'qType'        =>  $request->get('qType'),
                        'qType_status' => $request->get('qType_status'),
                        'modified_by'  => $user->emp_name,
                        'modified_ip'  => $_SERVER['REMOTE_ADDR']
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

    function updateQuestionTypeData(Request $request)
    {
        $qType_id = $request->input('qType_id');
        $questionType   = QuestionType::where('qType_id',$qType_id)->first();       
        $output   = array(
            'qType' =>$questionType->qType,
            'qType_status' =>$questionType->qType_status
            // 'board_id'         =>  $questionType->board_id,
            // 'medium_id'        =>  $questionType->medium_id,
            // 'class_id'         =>  $questionType->class_id,
            // 'subject_id'       =>  $questionType->subject_id,
            // 'chapter_id'       =>  $questionType->chapter_id,
            // 'topic_id'         =>  $questionType->topic_id,
            // 'question_type'    =>  $questionType->question_type,
            // 'question_type_description' =>  $questionType->question_type_description,
            // 'question_type_status' => $questionType->question_type_status
        );
        echo json_encode($output);
    }
    
    public function deleteQuestionTypeData(Request $request)
    {
        $questionTypeID = $request->qType_id;

        if (!is_null($questionTypeID)) {
            // $questionType = QuestionType::where('question_type_id', $questionTypeID)->first();

            // if ($questionType) {
            //     $questionType->delete();
            $questionType = QuestionType::find($questionTypeID);
            if ($questionType) {
                $questionType->delete();
                //$questionType->update(['qType_status' => 'InActive']);
                echo '<div class="alert alert-success">Data Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Question Type not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Question Type ID'], 400);
        }
    }

    public function deleteMultipleQuestionTypeData(Request $request)
    {
        $ids = $request->input('qType_ids');
        if (is_string($ids) && !empty($ids)) {
            // Convert comma-separated string to an array
            $qTypeIdsArray = explode(',', $ids);
            // Remove any empty values
            $qTypeIdsArray = array_filter($qTypeIdsArray);
            if (!empty($qTypeIdsArray)) {
                // Perform the delete operation based on the provided IDs
                QuestionType::whereIn('qType_id', $qTypeIdsArray)->delete();
                echo '<div class="alert alert-success">All QuestionType Deleted.</div>';
            } else {
                return response()->json(['error' => 'Invalid or empty QuestionType_ids provided'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid or empty QuestionType_ids provided'], 400);
        }
    }

}
