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

class McqPaperController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    // MCQ Paper List
    public function mcqpaperlist(Request $request){
        $this->arr_view_data['McqPaperList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['McqPaperList'] = $this->arr_view_data['McqPaperList'] ?? collect();
        return view($this->module_view_folder.'.mcqpaperlist', $this->arr_view_data);
    }

    public function getQuestionPaperAllData(){
        $error_array = array();
        $success_output = '';
        // SELECT mcq.id,bd.board_name, mediums.medium, cd.class_name, sd.subject_name, brdt.branch_name ,mcq.chepter_ids , mcq.question_counter, mcq.created_at, ad.admin_class FROM mcq_master mcq LEFT JOIN board_details bd ON mcq.fk_board_id = bd.board_id LEFT JOIN medium_details md ON mcq.fk_medium_id = md.medium_id LEFT JOIN class_details cd ON mcq.fk_class_id = cd.class_id LEFT JOIN subject_details sd ON mcq.fk_subject_id = sd.subject_id LEFT JOIN branch_details brdt ON mcq.fk_branch_id = brdt.branch_id LEFT JOIN admin ad ON mcq.user_id = ad.admin_id order by mcq.created_at DESC

        $question = McqModel::select('mcq_master.id', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'mcq_master.chepter_ids', 'mcq_master.question_counter', 'mcq_master.created_at', 'mcq_master.created_by')
        ->join('board_details', 'mcq_master.fk_board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'mcq_master.fk_medium_id', '=', 'medium_details.medium_id')
        ->join('class_details', 'mcq_master.fk_class_id', '=', 'class_details.class_id')
        ->join('subject_details', 'mcq_master.fk_subject_id', '=', 'subject_details.subject_id')
        // ->join('users', 'mcq_master.user_id', '=', 'users.admin_id')
        ->orderBy('mcq_master.id', 'asc')
        ->get();
        if($question){
            $success_output = '<div class="alert alert-success">Get MCQ Paper Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">MCQ Paper Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($question);
    }

    public function createMcqPaper(Request $request){
        $this->arr_view_data['BoardList'] = Board::get(["board_name", "board_id"]);
        $this->arr_view_data['BoardList'] = $this->arr_view_data['BoardList'] ?? collect();

        return view($this->module_view_folder.'.create_mcq_paper', $this->arr_view_data);
    }

    public function addMcqPaperDetails(Request $request){
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
                $mcqQuestion = new McqModel([
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
                $mcqQuestion->save();
                $mcq_id = $mcqQuestion->id;
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

    public function genrate_mcq_papers($request,$mcq_id){
        $paper_data = McqModel::where('id', $mcq_id)->first();
        if (!empty($paper_data) &&  $paper_data != false) {
            $chepter_data = explode(",", $paper_data->chepter_ids);
            $question_counter_data = explode(",", $paper_data->question_counter);
            $question_ids = [];
            foreach ($chepter_data as $key => $onechpter){
                $question_data = QuestionBank::select('question_bank.question_bank_id')
                                    ->from('question_bank')
                                    ->leftJoin('question_types', 'question_bank.question_type_id', '=', 'question_types.question_type_id')
                                    ->where('question_bank.chapter_id', $onechpter)
                                    ->where('question_types.question_type', 'MCQ')
                                    ->orderBy(DB::raw('RAND()'))
                                    ->limit($request->question_counter[$key])->get();

                if (!empty($question_data) && count($question_data) > 0){
                    foreach ($question_data as $key => $questionid)
                        array_push($question_ids, $questionid->question_id);
                }
            }
            $mcqPaper = McqModel::find($mcq_id);
            if ($mcqPaper) {
                $mcqPaper->update([
                    'paper_question_ids' => implode(",", $question_ids)
                ]);
            }
        }
    }

    public function getAllMCQPaperData(){
        $error_array = array();
        $success_output = '';
        $question = McqModel::select('mcq_master.id', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'mcq_master.chepter_ids', 'mcq_master.question_counter', 'mcq_master.created_at', 'mcq_master.created_by')
        ->join('board_details', 'mcq_master.fk_board_id', '=', 'board_details.board_id')
        ->join('medium_details', 'mcq_master.fk_medium_id', '=', 'medium_details.medium_id')
        ->join('class_details', 'mcq_master.fk_class_id', '=', 'class_details.class_id')
        ->join('subject_details', 'mcq_master.fk_subject_id', '=', 'subject_details.subject_id')
        ->orderBy('mcq_master.id', 'asc')
        ->get();
        if($question){
            $success_output = '<div class="alert alert-success">Get MCQ Paper Data !!!</div>';
        }else{
            $success_output = '<div class="alert alert-danger">MCQ Paper Data Not Available !!!</div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($question);
    }

    public function getSelectedMCQChapterDataAjax(Request $request){
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

    public function deleteMCQPaperData(Request $request)
    {
        $mcqPaperID = $request->question_id;

        if (!is_null($mcqPaperID)) {
            $mcqQues = McqModel::where('id', $mcqPaperID)->first();
            if ($mcqQues) {
                $mcqQues->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
            } else {
                return response()->json(['message' => 'MCQ Question Paper not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid MCQ Question Paper ID'], 400);
        }
    }

    public function viewMCQPaper($paper_id){
        $question_paper = McqModel::select('mcq_master.id', 'mcq_master.user_id', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'mcq_master.chepter_ids', 'mcq_master.paper_question_ids', 'mcq_master.created_at', 'mcq_master.created_by')
                ->join('board_details', 'mcq_master.fk_board_id', '=', 'board_details.board_id')
                ->join('medium_details', 'mcq_master.fk_medium_id', '=', 'medium_details.medium_id')
                ->join('class_details', 'mcq_master.fk_class_id', '=', 'class_details.class_id')
                ->join('subject_details', 'mcq_master.fk_subject_id', '=', 'subject_details.subject_id')
                ->where('mcq_master.id', $paper_id)
                ->first();
        
        $inperms = implode("','", explode(",", $question_paper->paper_question_ids));
        $options_data = McqOptions::select('question_id','option_sequence','option_detail','is_answer')->whereIn('question_id', [$inperms])->get()->toArray();
        $question_data = QuestionBank::whereIn('question_id', [$inperms])->get()->toArray();
        $response = [
			'question_paper' => $question_paper,
			'questions' => $question_data,
			'options' => $options_data,
            'user_id' => $question_paper->user_id
		];
        $paper_stack = json_decode(json_encode($response));
        $settings_result = getPaperSettings($paper_stack->user_id);
        $this->arr_view_data['paper_stack'] = $paper_stack;
        $this->arr_view_data['settings_result'] = $settings_result;
        return view($this->module_view_folder.'.view_mcq_paper', $this->arr_view_data);
    }

    public function viewMCQSolution($paper_id){
        $question_paper = McqModel::select('mcq_master.id', 'mcq_master.user_id', 'board_details.board_name', 'medium_details.medium', 'class_details.class_name', 'subject_details.subject_name', 'mcq_master.chepter_ids', 'mcq_master.paper_question_ids', 'mcq_master.created_at', 'mcq_master.created_by')
                ->join('board_details', 'mcq_master.fk_board_id', '=', 'board_details.board_id')
                ->join('medium_details', 'mcq_master.fk_medium_id', '=', 'medium_details.medium_id')
                ->join('class_details', 'mcq_master.fk_class_id', '=', 'class_details.class_id')
                ->join('subject_details', 'mcq_master.fk_subject_id', '=', 'subject_details.subject_id')
                ->where('mcq_master.id', $paper_id)
                ->first();       
        
        $inperms = '';
        $question_data = [];
        if(!empty($question_paper->paper_question_ids)){
            $inperms = implode("','", explode(",", $question_paper->paper_question_ids));
            $question_data = QuestionBank::whereIn('question_id', [$inperms])->get()->toArray();
        }
        $options_data = McqOptions::select('question_id','option_sequence','option_detail','is_answer')->whereIn('question_id', [$inperms])->get()->toArray();
        $response = [
			'question_paper' => $question_paper,
			'questions' => $question_data,
			'options' => $options_data,
            'user_id' => $question_paper->user_id
		];
        $paper_stack = json_decode(json_encode($response));
        $settings_result = getPaperSettings($paper_stack->user_id);
        $this->arr_view_data['paper_stack'] = $paper_stack;
        $this->arr_view_data['settings_result'] = $settings_result;
        return view($this->module_view_folder.'.view_mcq_paper_solution', $this->arr_view_data);
    }
}