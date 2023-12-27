<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use Validator;
use DataTables;

class StandardController extends Controller
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
        $class = Standard::select('class.class_id', 'class.board_id', 'class.medium_id' , 'class.class_name', 'class.class_description', 'class.class_status','class.created_at', 'class.updated_at', 'boards.board_name','mediums.medium_name')
        ->join('boards', 'class.board_id', '=', 'boards.board_id')
        ->join('mediums', 'class.medium_id', '=', 'mediums.medium_id')
        ->orderBy('class.class_id', 'asc')
        ->get();

        $data['classList'] = $class;
        return view($this->module_view_folder.'.standard', $this->arr_view_data,$data);
    }

    // public function getMedium(Request $request){
    //     $mediumList = Medium::where('board_id',$request->board_id)->get();
    //     $html = '';
    //     foreach ($mediumList as $mediumDet) {
    //         $html .= '<option value="' . $mediumDet->medium_id . '">' . $mediumDet->medium_name . '</option>';
    //     }        
    //     echo $html;
    // }
    public function getMedium(Request $request){
        $mediumList = Medium::where('board_id',$request->board_id)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $html .= '<option value="' . $mediumDet->medium_id . '">' . $mediumDet->medium_name . '</option>';
        }        
        echo $html;
    }
    
    public function getClassAllData(){
        // $class= Standard::select('class.class_id', 'class.board_id', 'class.medium_id' , 'class.class_name', 'class.class_description', 'class.class_status','class.created_at', 'class.updated_at', 'boards.board_name','mediums.medium_name')
        //     ->join('boards', 'class.board_id', '=', 'boards.board_id')
        //     ->join('mediums', 'class.medium_id', '=', 'mediums.medium_id')
        //     ->orderBy('class.class_id', 'asc')
        //     ->get(); //toSql
        // echo json_encode($class);
        $build_result = array();
        $class= Standard::select('class.class_id', 'class.board_id', 'class.medium_id' , 'class.class_name', 'class.class_description', 'class.class_status','class.created_at', 'class.updated_at', 'boards.board_name','mediums.medium_name')
                ->join('boards', 'class.board_id', '=', 'boards.board_id')
                ->join('mediums', 'class.medium_id', '=', 'mediums.medium_id')
                ->orderBy('class.class_id', 'asc')
                ->latest();
        $json_result = DataTables::of($class)
            ->addColumn('built_action_btns', function ($data) {
                 return '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->class_id.'" data-toggle="modal" title="Update Class Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->class_id.'" data-toggle="modal" name="button" title="Delete Class Details"><i class="fas fa-trash-alt"></i></button>';
            })->make(true);
		$build_result = $json_result->getData();

        if (isset($build_result->data) && sizeof($build_result->data) > 0) {
            $i = 0;
            foreach ($build_result->data as $key => $data) {
                $i = $i + 1;
                $build_result->data[$key]->class_id  = $data->class_id;
                $build_result->data[$key]->board_name = $data->board_name;
                $build_result->data[$key]->medium_name = $data->medium_name;
                $build_result->data[$key]->class_name = $data->class_name;
                $build_result->data[$key]->class_description = $data->class_description;
                $build_result->data[$key]->class_status = $data->class_status;
                $build_result->data[$key]->created_at = date("d M Y", strtotime($data->created_at));
                $action = '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-medium-id="'.$data->medium_id.'" data-id="'.$data->class_id.'" data-toggle="modal"  title="Update Class Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->class_id.'" data-toggle="modal"   name="button" title="Delete Class Details"><i class="fas fa-trash-alt"></i></button>';
				$build_result->data[$key]->built_action_btns = $action;
            }
            return response()->json($build_result);
        } else {
            return response()->json($build_result);
        }
    }

    public function addClass(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'class_name'  => 'required'
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
                $Standard = new Standard([
                    'board_id'      =>  $request->get('board_id'),
                    'medium_id'     =>  $request->get('medium_id'),
                    'class_name'    =>  $request->get('class_name'),
                    'class_description' => $request->get('class_description'),
                    'class_status'    => $request->get('class_status'),
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $Standard->save();
                $success_output = '<div class="alert alert-success">Class Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $Standard = Standard::find($request->get('class_id'));
            
                if ($Standard) {
                    $Standard->update([
                        'board_id' => $request->get('board_id'),
                        'medium_id' => $request->get('medium_id'),
                        'class_name' => $request->get('class_name'),
                        'class_description' =>  $request->get('class_description'),
                        'class_status' => $request->get('class_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
            
                    $success_output = '<div class="alert alert-success">Class Data Updated !!!</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Class not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function updateGetClassData(Request $request)
    {
        $class_id  = $request->input('class_id');
        $classDetails  = Standard::where('class_id',$class_id)->first();
        $output    = array(
            'board_id'        =>  $classDetails->board_id,
            'medium_id'       =>  $classDetails->medium_id,
            'class_name'      =>  $classDetails->class_name,
            'class_description' =>  $classDetails->class_description,
            'class_status'      =>  $classDetails->class_status,
            // 'topic_name'      =>  $topicDetails->topic_name,
            // 'topic_status' => $topicDetails->topic_status
        );
        echo json_encode($output);
        
        
        // $medium_id  = $request->input('medium_id');
        // $selectedBoardId  = $request->input('board_id');
        // $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        // $html = '';
        // foreach ($mediumList as $mediumDet) {
        //     $isSelected = ($mediumDet->medium_id == $medium_id) ? 'selected' : '';
        //     $html .= '<option value="' . $mediumDet->medium_id . '" ' . $isSelected . '>' . $mediumDet->medium_name . '</option>';
        // } 
        // dd($html);
        // $selectedClassId  = $request->input('class_id');     
        // $standard  = Standard::find($selectedClassId);
        // $output    = array(
        //     'board_id'       =>  $standard->board_id,
        //     'medium_id'      =>  $html,
        //     'class_name'     =>  $standard->class_name,
        //     'class_description' =>  $standard->class_description,
        //     'class_status' => $standard->class_status
        // );
        // echo json_encode($output);
    }

    public function deleteClassData(Request $request)
    {
        $standard_id = $request->class_id;

        if (!is_null($standard_id)) {
            $standard = Board::find($standard_id);
    
            if ($standard) {
                $standard->update(['class_status' => 'No']);
                echo '<div class="alert alert-success">Class Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Class not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Class ID'], 400);
        }
    }
}
