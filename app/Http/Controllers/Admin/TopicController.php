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
use App\Models\Topic;
use Validator;
use DB;
use DataTables;

class TopicController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {
        $data['BoardList']   = Board::get(["board_name", "board_id"]);
        $data['BoardList']   = $data['BoardList'] ?? collect();

        $topic = Topic::select('topic_details.topic_id','topic_details.class_id','topic_details.board_id','topic_details.medium_id','topic_details.topic_name','topic_details.created_on','board_details.board_name','medium_details.medium','class_details.class_name','subject_details.subject_name','chapter_details.chapter_name')
        ->join('class_details', 'class_details.class_id', '=', 'topic_details.class_id')
        ->join('board_details', 'topic_details.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'topic_details.medium_id', '=', 'medium_details.medium_id')
        ->join('subject_details', 'topic_details.subject_id', '=', 'subject_details.subject_id')
        ->join('chapter_details', 'topic_details.chapter_id', '=', 'chapter_details.chapter_id')
        ->orderBy('topic_details.topic_id', 'asc')
        ->get();

        $data['topicList'] = $topic;
        $count = Topic::count();
        $this->arr_view_data['topic_count'] = $count;
        return view($this->module_view_folder.'.topic', $this->arr_view_data,$data);
    }

    public function getMedium(Request $request){
        $mediumList = Medium::where('board_id',$request->board_id)->orderBy('medium','ASC')->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $html .= '<option value="' . $mediumDet->medium_id . '">' . $mediumDet->medium. '</option>';
        }        
        echo $html;
    }

    public function getClassesAjax(Request $request){
        $classList = Standard::where('medium_id',$request->medium_id)->get();
        $html = '';
        foreach ($classList as $classDet) {
            $html .= '<option value="' . $classDet->class_id . '">' . $classDet->class_name . '</option>';
        }        
        echo $html;
    }

    public function getSubjectsAjax(Request $request){
        $subjectList = Subject::where('class_id',$request->class_id)->get();
        $html = '';
        foreach ($subjectList as $subjectDet) {
            $html .= '<option value="' . $subjectDet->subject_id . '">' . $subjectDet->subject_name . '</option>';
        }        
        echo $html;
    }

    public function getChapterAjax(Request $request){
        $chapterList = Chapter::where('subject_id',$request->subject_id)->get();
        $html = '';
        foreach ($chapterList as $chapterDet) {
            $html .= '<option value="' . $chapterDet->chapter_id . '">' . $chapterDet->chapter_name . '</option>';
        }        
        echo $html;
    }

    public function getTopicAllData(){
        $build_result = array();

        $topic = Topic::select('topic_details.topic_id','topic_details.class_id','topic_details.board_id','topic_details.medium_id','topic_details.subject_id','topic_details.chapter_id','topic_details.topic_name','topic_details.created_on','topic_details.topic_status','board_details.board_name','medium_details.medium','class_details.class_name','chapter_details.chapter_name','subject_details.subject_name')
        ->join('class_details', 'class_details.class_id', '=', 'topic_details.class_id')
        ->join('board_details', 'topic_details.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'topic_details.medium_id', '=', 'medium_details.medium_id')
        ->join('chapter_details', 'topic_details.chapter_id', '=', 'chapter_details.chapter_id')
        ->join('subject_details', 'topic_details.subject_id', '=', 'subject_details.subject_id')
        ->get();

        /* $json_result = DataTables::of($topic)
        ->addColumn('built_action_btns', function ($data) {
            return '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->topic_id.'" data-toggle="modal" title="Update Topic Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->topic_id.'" data-toggle="modal" name="button" title="Delete Topic Details"><i class="fas fa-trash-alt"></i></button>';
        })->make(true);
		$build_result = $json_result->getData();

        if (isset($build_result->data) && sizeof($build_result->data) > 0) {
            $i = 0;
            foreach ($build_result->data as $key => $data) {
                $i = $i + 1;
                $build_result->data[$key]->topic_id  = $data->topic_id;
                $build_result->data[$key]->board_name = $data->board_name;
                $build_result->data[$key]->medium_name = $data->medium_name;
                $build_result->data[$key]->class_name = $data->class_name;
                $build_result->data[$key]->subject_name = $data->subject_name;
                $build_result->data[$key]->chapter_name = $data->chapter_name;
                $build_result->data[$key]->topic_name = $data->topic_name;
                $build_result->data[$key]->created_at = date("d M Y", strtotime($data->created_at));
                $action = '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->topic_id.'" data-toggle="modal"  title="Update Topic Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->topic_id.'" data-toggle="modal"   name="button" title="Delete Topic Details"><i class="fas fa-trash-alt"></i></button>';
				$build_result->data[$key]->built_action_btns = $action;
            }
            return response()->json($build_result);
        } else {
            return response()->json($build_result);
        } */
        echo json_encode($topic);
    }

    public function addTopic(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'topic_name'  => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            if($request->get('button_action') == "insert") {
                $Topic = new Topic([
                    'topic_id'      => strtoupper(substr(uniqid("topic"."_".md5(uniqid("topic", true))), 0,15)),
                    'board_id'      => $request->get('board_id'),
                    'medium_id'     => $request->get('medium_id'),
                    'class_id'      => $request->get('class_id'),
                    'subject_id'    => $request->get('subject_id'),
                    'chapter_id'    => $request->get('chapter_id'),
                    'topic_name'    => $request->get('topic_name'),
                    'topic_status'  => $request->get('topic_status'),
                    'created_by'    => $user->emp_name,
                    'creation_ip'   => $_SERVER['REMOTE_ADDR']
                ]);
                $Topic->save();
                $success_output = '<div class="alert alert-success">Topic Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $Topic = Topic::find($request->get('topic_id'));
            
                if ($Topic) {
                    $Topic->update([
                        'board_id' => $request->get('board_id'),
                        'medium_id' => $request->get('medium_id'),
                        'class_id' => $request->get('class_id'),
                        'subject_id' => $request->get('subject_id'),
                        'chapter_id' => $request->get('chapter_id'),
                        'topic_name' => $request->get('topic_name'),
                        'topic_status' => $request->get('topic_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
                    $success_output = '<div class="alert alert-success">Topic Data Updated !!!</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Topic not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function updateGetTopicData(Request $request)
    {
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $class_id   = $request->input('class_id');
        $subject_id   = $request->input('subject_id');
        $chapter_id   = $request->input('chapter_id');
        $topic_id   = $request->input('topic_id');
        
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $classList  = Standard::where('class_id',$class_id)->get();
        $subjectList = Subject::where('subject_id',$subject_id)->get();
        $chapterList = Chapter::where('chapter_id',$chapter_id)->get();
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

        $topic_id = $request->input('topic_id');
        $topicDetails  = Topic::where('topic_id',$topic_id)->first();
        $output   = array(
            'board_id'      =>  $topicDetails->board_id,
            'medium_id'     =>  $html,
            'class_id'     =>  $htmlClass,
            'subject_id' => $htmlsubject,
            'chapter_id' => $htmlchapter,
            'topic_id' => $topic_id,
            'topic_name' =>  $topicDetails->topic_name,
            'topic_status' => $topicDetails->topic_status
        );
        echo json_encode($output);
    }

    public function deleteTopicData(Request $request)
    {
        $topicID = $request->topic_id;

        if (!is_null($topicID)) {
            $Topic = Topic::where('topic_id', $topicID)->first();

            if ($Topic) {
                $Topic->delete();
                echo '<div class="alert alert-success">Topic Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Topic not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Topic ID'], 400);
        }
    }

    public function deleteMultipleTopicData(Request $request)
    {
        $ids = $request->input('topic_ids');
        if (is_string($ids) && !empty($ids)) {
            // Convert comma-separated string to an array
            $topicIdsArray = explode(',', $ids);
            // Remove any empty values
            $topicIdsArray = array_filter($topicIdsArray);
            if (!empty($topicIdsArray)) {
                // Perform the delete operation based on the provided IDs
                Topic::whereIn('topic_id', $topicIdsArray)->delete();
                echo '<div class="alert alert-success">All Topic Deleted.</div>';
            } else {
                return response()->json(['error' => 'Invalid or empty Topic_ids provided'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid or empty Topic_ids provided'], 400);
        }
    }
}
