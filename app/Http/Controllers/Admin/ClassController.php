<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use Validator;

class ClassController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.class', $this->arr_view_data,$data);
    }

    public function getMedium(Request $request){
        $mediumList = Medium::where('board_id',$request->board_id)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $html .= '<option value="' . $mediumDet->medium_id . '">' . $mediumDet->medium_name . '</option>';
        }        
        echo $html;
    }

    public function getClassAllData(){
        $class= Standard::select('class.class_id', 'class.board_id', 'class.medium_id' , 'class.class_name', 'class.class_description', 'class.class_status','class.created_at', 'class.updated_at', 'boards.board_name','mediums.medium_name')
            ->join('boards', 'class.board_id', '=', 'boards.board_id')
            ->join('mediums', 'class.medium_id', '=', 'mediums.medium_id')
            ->orderBy('class.class_id', 'asc')
            ->get(); //toSql
        echo json_encode($class);

    }

    public function addClass(Request $request){
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
                    'class_status'    => $request->get('class_status')
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
                        'class_status' => $request->get('class_status')
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
        $medium_id  = $request->input('medium_id');
        $selectedBoardId  = $request->input('board_id');
        $mediumList = Medium::where('board_id',$selectedBoardId)->get();
        $html = '';
        foreach ($mediumList as $mediumDet) {
            $isSelected = ($mediumDet->medium_id == $medium_id) ? 'selected' : '';
            $html .= '<option value="' . $mediumDet->medium_id . '" ' . $isSelected . '>' . $mediumDet->medium_name . '</option>';
        } 
        $selectedClassId  = $request->input('class_id');     
        $standard  = Standard::find($selectedClassId);
        $output    = array(
            'board_id'       =>  $standard->board_id,
            'medium_id'      =>  $html,
            'class_name'     =>  $standard->class_name,
            'class_description' =>  $standard->class_description,
            'class_status' => $standard->class_status
        );
        echo json_encode($output);
    }

    public function deleteClassData(Request $request)
    {
        $classID = $request->class_id;

        if (!is_null($classID)) {
            $Standard = Standard::where('class_id', $classID)->first();

            if ($Standard) {
                $Standard->delete();
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
