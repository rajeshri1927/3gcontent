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
        $data['MediumList']  = Medium::get(["medium_name", "medium_id"]);
        $data['MediumList']  = $data['MediumList'] ?? collect();
        $data['ClassList']   = Standard::get(["class_name", "class_id"]);
        $data['ClassList']   = $data['ClassList'] ?? collect();
        $data['SubjectList'] = Subject::get(["subject_name", "subject_id"]);
        $data['SubjectList'] = $data['SubjectList'] ?? collect();
        $data['ChapterList'] = Chapter::get(["chapter_name", "chapter_id"]);
        $data['ChapterList'] = $data['ChapterList'] ?? collect();

        $topic = Topic::select('topics.topic_id','topics.class_id','topics.board_id','topics.medium_id','topics.topic_name','chapters.created_at','boards.board_name','mediums.medium_name','class.class_name','subjects.subject_name','chapters.chapter_name')
        ->join('class', 'class.class_id', '=', 'topics.class_id')
        ->join('boards', 'topics.board_id', '=', 'boards.board_id')
        ->join('mediums', 'topics.medium_id', '=', 'mediums.medium_id')
        ->join('subjects', 'topics.subject_id', '=', 'subjects.subject_id')
        ->join('chapters', 'topics.chapter_id', '=', 'chapters.chapter_id')
        ->orderBy('topics.topic_id', 'asc')
        ->get();

        $data['topicList'] = $topic;
        return view($this->module_view_folder.'.topic', $this->arr_view_data,$data);
    }

    public function getMedium(Request $request){
        $mediumList = Medium::where('board_id',$request->board_id)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $html .= '<option value="' . $mediumDet->medium_id . '">' . $mediumDet->medium_name . '</option>';
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

        $topic = Topic::select('topics.topic_id','topics.class_id','topics.board_id','topics.medium_id','topics.topic_name','topics.created_at','topics.topic_status','boards.board_name','mediums.medium_name','class.class_name','chapters.chapter_name','subjects.subject_name')
        ->join('class', 'class.class_id', '=', 'topics.class_id')
        ->join('boards', 'topics.board_id', '=', 'boards.board_id')
        ->join('mediums', 'topics.medium_id', '=', 'mediums.medium_id')
        ->join('chapters', 'topics.chapter_id', '=', 'chapters.chapter_id')
        ->join('subjects', 'topics.subject_id', '=', 'subjects.subject_id')
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
                    'board_id'      =>  $request->get('board_id'),
                    'medium_id'     =>  $request->get('medium_id'),
                    'class_id'     =>  $request->get('class_id'),
                    'subject_id' => $request->get('subject_id'),
                    'chapter_id' => $request->get('chapter_id'),
                    'topic_name'    =>  $request->get('topic_name'),
                    'topic_status' => $request->get('topic_status'),
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
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
        $topic_id  = $request->input('topic_id');
        $topicDetails  = Topic::where('topic_id',$topic_id)->first();
        $output    = array(
            'board_id'       =>  $topicDetails->board_id,
            'medium_id'      =>  $topicDetails->medium_id,
            'class_id'      =>  $topicDetails->class_id,
            'subject_id'      =>  $topicDetails->subject_id,
            'chapter_id'      =>  $topicDetails->chapter_id,
            'topic_name'     =>  $topicDetails->topic_name,
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
}
