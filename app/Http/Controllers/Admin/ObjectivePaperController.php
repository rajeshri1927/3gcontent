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
use Validator;
use DB;

class ObjectivePaperController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    // Objective Paper List
    public function objectivepaperlist(Request $request){
        $this->arr_view_data['ObjectivePaperList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['ObjectivePaperList'] = $this->arr_view_data['ObjectivePaperList'] ?? collect();
        return view($this->module_view_folder.'.objectivepaperlist', $this->arr_view_data);
    }

    public function createObjectivePaper(Request $request){
        $this->arr_view_data['BoardList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['BoardList'] = $this->arr_view_data['BoardList'] ?? collect();

        return view($this->module_view_folder.'.create_objective_paper', $this->arr_view_data);
    }

    public function addObjectivePaperDetails(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'board_id'    => 'required',
            'medium_id'    => 'required',
            'class_id'    => 'required',
            'subject_id'    => 'required'
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
                $objectiveQuestion = new McqModel([
                                    'fk_board_id' => $request->board_id,
                                    'fk_medium_id' => $request->medium_id,
                                    'fk_class_id' => $request->class_id,
                                    'fk_subject_id' => $request->subject_id,
                                    'chepter_ids' => implode(",", $request->filterchaptername2),
                                    'question_counter' => implode(",", $request->question_counter),
                                    'user_id' => $user->id,
                                    'status' => 1,
                                    'created_by' => $user->name
                                ]);
                $objectiveQuestion->save();
                $mcq_id = $objectiveQuestion->id;
                $this->genrate_mcq_papers($request,$mcq_id);
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'redirect_url'   =>  url('/admin/mcqpaper')
        );
        echo json_encode($output);        
    }

    public function deleteObjectivePaperData(Request $request)
    {
        $objectivePaperID = $request->question_id;

        if (!is_null($objectivePaperID)) {
            $objectiveQues = McqModel::where('id', $objectivePaperID)->first();
            if ($objectiveQues) {
                $objectiveQues->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
            } else {
                return response()->json(['message' => 'Objective Question Paper not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Objective Question Paper ID'], 400);
        }
    }

    public function viewObjectivePaper($paper_id){
        $question_paper = QuestionBank::select('board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'question_list.chapter_id', 'question_list.created_on', 'question_list.created_by', 'chapter_details.chapter_name')
                ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
                ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
                ->join('class_details', 'question_list.class_id', '=', 'class_details.class_id')
                ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
                ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
                ->where('question_list.question_type', '!=', 'MCQ')
                ->where('question_list.question_id', $paper_id)
                ->first();
        
        $inperms = '';
        $question_data = [];
        $paperIds = [];
        if(!empty($question_paper->paper_question_ids)){
            $inperms = explode(",", $question_paper->paper_question_ids);
            $paperIds = [];
            foreach($inperms as $inperm){
                $paperIds[] = $inperm;
            }
            // $inperms = implode("','", explode(",", $question_paper->paper_question_ids));
        }
        $question_data = QuestionBank::whereIn('question_id', $paperIds)->get()->toArray();
        $options_data = McqOptions::select('question_id','option_sequence','option_detail','is_answer')->whereIn('question_id', $paperIds)->get()->toArray();
        $response = [
			'question_paper' => $question_paper,
			'questions' => $question_data,
			'options' => $options_data,
            'user_id' => $question_paper->created_by
		];
        $paper_stack = json_decode(json_encode($response));
        $settings_result = getPaperSettings($paper_stack->user_id);
        $this->arr_view_data['paper_stack'] = $paper_stack;
        $this->arr_view_data['settings_result'] = $settings_result;
        $this->arr_view_data['logo_file'] = $settings_result->logo_file;
        $this->arr_view_data['title'] = $settings_result->title;
        return view($this->module_view_folder.'.view_objective_paper', $this->arr_view_data);
    }

    public function getAllObjectivePaperData(){
        $error_array = array();
        $success_output = '';
        $question = QuestionBank::select('question_list.question_id', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'question_list.chapter_id', 'question_list.created_on', 'question_list.created_by', 'chapter_details.chapter_name')
        ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
        ->join('class_details', 'question_list.class_id', '=', 'class_details.class_id')
        ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
        ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
        ->where('question_list.question_type','!=','MCQ')
        ->orderBy('question_list.created_on', 'asc')
        ->take(50)
        ->get();
        if($question){
            $success_output = '<div class="alert alert-success">Get Objective Paper Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">Objective Paper Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($question);
    }

    public function getSelectedObjChapterDataAjax(Request $request){
        $chapterIDs = implode(",", $request->filterchapternames);
        $chapterIDs = [$chapterIDs];
        $results = \DB::table('chapter_details as cd')
                    ->select('cd.chapter_id', 'cd.chapter_name', \DB::raw('(SELECT COUNT(1) FROM question_list ql LEFT JOIN question_type_details qt ON qt.qType_id = ql.qType_id WHERE ql.chapter_id = cd.chapter_id AND qt.qType = "MCQ") AS question_counter'))
                    ->whereIn('cd.chapter_id', $chapterIDs)
                    ->orderByDesc('cd.chapter_id')
                    ->get();

        $chaptersRow = '<tr>';
        foreach($results as $chapters){
            $chaptersRow .= '<td>'.$chapters->chapter_name.'<input type="hidden" name="chapter_id[]" value="'.$chapters->chapter_id.'" /></td>';
            $chaptersRow .= '<td><input type="number" class="form-control formField" max="0" name="question_counter[]"></td>';
            $chaptersRow .= '<td>'.$chapters->question_counter.'</td>';
        }
        $chaptersRow .= '</tr>';
        return $chaptersRow;
    }

    public function viewObjectiveSolution($paper_id){
        $question_paper = QuestionBank::select('board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'question_list.chapter_id', 'question_list.created_on', 'question_list.created_by', 'chapter_details.chapter_name')
                ->join('board_details', 'question_list.board_id', '=', 'board_details.board_id')
                ->join('medium_details', 'question_list.medium_id', '=', 'medium_details.medium_id')
                ->join('class_details', 'question_list.class_id', '=', 'class_details.class_id')
                ->join('subject_details', 'question_list.subject_id', '=', 'subject_details.subject_id')
                ->join('chapter_details', 'question_list.chapter_id', '=', 'chapter_details.chapter_id')
                ->where('question_list.question_type', '!=', 'MCQ')
                ->where('question_list.question_id', $paper_id)
                ->first();
        
        $inperms = '';
        $question_data = [];
        $paperIds = [];
        
        if(!empty($question_paper->paper_question_ids)){
            foreach($inperms as $inperm){
                $paperIds[] = $inperm;
            }
            // $inperms = implode("','", explode(",", $question_paper->paper_question_ids));
            $question_data = QuestionBank::whereIn('question_id', $paperIds)->get()->toArray();
        }
        $options_data = McqOptions::select('question_id','option_sequence','option_detail','is_answer')->whereIn('question_id', $paperIds)->get()->toArray();
        $response = [
			'question_paper' => $question_paper,
			'questions' => $question_data,
			'options' => $options_data,
            'user_id' => $question_paper->created_by
		];
        $paper_stack = json_decode(json_encode($response));
        $settings_result = getPaperSettings($paper_stack->user_id);
        $this->arr_view_data['paper_stack'] = $paper_stack;
        $this->arr_view_data['settings_result'] = $settings_result;
        $this->arr_view_data['logo_file'] = $settings_result->logo_file;
        $this->arr_view_data['title'] = $settings_result->title;
        return view($this->module_view_folder.'.view_objective_paper_solution', $this->arr_view_data);
    }
}