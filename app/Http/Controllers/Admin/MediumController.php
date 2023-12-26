<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use Validator;

class MediumController extends Controller
{

    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.medium', $this->arr_view_data,$data);
    }

    public function getMediumAllData(){
        $mediums = Medium::select('mediums.medium_id', 'mediums.medium_name', 'mediums.medium_description' , 'mediums.board_id', 'mediums.medium_status', 'mediums.created_at', 'mediums.updated_at', 'boards.board_name')
            ->join('boards', 'mediums.board_id', '=', 'boards.board_id')
            ->orderBy('mediums.medium_id', 'asc')
            ->get();
        echo json_encode($mediums);
    }

    public function addMedium(Request $request){
        $validation = Validator::make($request->all(), [
            'medium_name'  => 'required'
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
                $board = new Medium([
                    'medium_name'    =>  $request->get('medium_name'),
                    'board_id' =>  $request->get('board_id'),
                    'medium_description' => $request->get('medium_description'),
                    'medium_status' => $request->get('medium_status')
                ]);
                $board->save();
                $success_output = '<div class="alert alert-success">Medium Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $medium = Medium::find($request->get('medium_id'));
            
                if ($medium) {
                    $medium->update([
                        'medium_name' => $request->get('medium_name'),
                        'board_id' => $request->get('board_id'),
                        'medium_description' =>  $request->get('medium_description'),
                        'medium_status' => $request->get('medium_status')
                    ]);
            
                    $success_output = '<div class="alert alert-success">Medium Data Updated !!!</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Medium not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function updateGetMediumData(Request $request)
    {
        $medium_id = $request->input('medium_id');
        $medium     = Medium::find($medium_id);
        $output    = array(
            'medium_name'  =>  $medium->medium_name,
            'board_id'     =>  $medium->board_id,
            'medium_description' =>  $medium->medium_description,
            'medium_status' => $medium->medium_status
        );
        echo json_encode($output);
    }
    
    public function deleteMediumData(Request $request)
    {
        $mediumId = $request->medium_id;

        if (!is_null($mediumId)) {
            $medium = Medium::where('medium_id', $mediumId)->first();

            if ($medium) {
                $medium->delete();
                echo '<div class="alert alert-success">Medium Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Medium not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Medium ID'], 400);
        }
    }

}
