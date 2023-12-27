<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return view($this->module_view_folder.'.questiontype', $this->arr_view_data);
    }

    public function getQuestionTypeData(){
        $questionType = QuestionType::select('*')->where('question_type_status','Yes')->orderBy('question_type_id','asc')->get();
        echo json_encode($questionType);
    }

    public function addQuestionType(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'question_type'    => 'required'
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
                    'question_type'    =>  $request->get('question_type'),
                    'question_type_description' =>  $request->get('question_type_description'),
                    'question_type_status' => $request->get('question_type_status'),
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $questionType->save();
                $success_output = '<div class="alert alert-success">Question Type Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $question_type = QuestionType::find($request->get('question_type_id'));
            
                if ($question_type) {
                    $question_type->update([
                        'question_type'    =>  $request->get('question_type'),
                        'question_type_description' =>  $request->get('question_type_description'),
                        'question_type_status' => $request->get('question_type_status'),
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

    function updateQuestionTypeData(Request $request)
    {
        $questionTypeID = $request->input('question_type_id');
        $questionType   = QuestionType::find($questionTypeID);
        $output   = array(
            'question_type'    =>  $questionType->question_type,
            'question_type_description' =>  $questionType->question_type_description,
            'question_type_status' => $questionType->question_type_status
        );
        echo json_encode($output);
    }
    
    public function deleteQuestionTypeData(Request $request)
    {
        $questionTypeID = $request->question_type_id;

        if (!is_null($questionTypeID)) {
            // $questionType = QuestionType::where('question_type_id', $questionTypeID)->first();

            // if ($questionType) {
            //     $questionType->delete();
            $questionType = QuestionType::find($questionTypeID);
            if ($questionType) {
                $questionType->update(['question_type_status' => 'No']);
                echo '<div class="alert alert-success">Data Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Question Type not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Question Type ID'], 400);
        }
    }

}
