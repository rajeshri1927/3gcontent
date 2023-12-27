<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Board;
use Validator;
use DB;
use DataTables;

class BoardController extends Controller
{
    
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {     
        return view($this->module_view_folder.'.board', $this->arr_view_data);
    }

    public function getBoardAllData(){
        $build_result = array();

        $boards = Board::select('*')->orderBy('board_id','asc')->get();

        $json_result = DataTables::of($boards)->addColumn('built_action_btns', function ($data) {
            return '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->board_id.'" data-toggle="modal" title="Update Board Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->board_id.'" data-toggle="modal" name="button" title="Delete Board Details"><i class="fas fa-trash-alt"></i></button>';
        })->make(true);
		$build_result = $json_result->getData();

        if (isset($build_result->data) && sizeof($build_result->data) > 0) {
            $i = 0;
            foreach ($build_result->data as $key => $data) {
                $i = $i + 1;
                $build_result->data[$key]->board_id = $data->board_id;
                $build_result->data[$key]->board_name = $data->board_name;
                $build_result->data[$key]->board_description = $data->board_description;
                $build_result->data[$key]->board_status = $data->board_status;
                $build_result->data[$key]->created_at = date("d M Y", strtotime($data->created_at));
                $action = '<button class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->board_id.'" data-toggle="modal"  title="Update Board Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->board_id.'" data-toggle="modal"  title="Delete Board Details"><i class="fas fa-trash-alt"></i></button>';
				$build_result->data[$key]->built_action_btns = $action;
            }
            return response()->json($build_result);
        } else {
            return response()->json($build_result);
        }
    }
    
    public function addBoard(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'board_name'    => 'required'
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
                $board = new Board([
                    'board_name'    =>  $request->get('board_name'),
                    'board_description' =>  $request->get('board_description'),
                    'board_status' => $request->get('board_status'),
                    'created_by' => $user->name,
                    'creation_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                $board->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
            if ($request->get('button_action') == 'update') {
                $board = Board::find($request->get('board_id'));
            
                if ($board) {
                    $board->update([
                        'board_name' => $request->get('board_name'),
                        'board_description' => $request->get('board_description'),
                        'board_status' => $request->get('board_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
                    ]);
            
                    $success_output = '<div class="alert alert-success">Data Updated</div>';
                } else {
                    // Handle the case when the board is not found
                    $success_output = '<div class="alert alert-danger">Board not found</div>';
                }
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function updateBoarddata(Request $request)
    {
        $board_id = $request->input('board_id');
        $board    = Board::find($board_id);
        $output   = array(
            'board_name'    =>  $board->board_name,
            'board_description' =>  $board->board_description,
            'board_status' => $board->board_status
        );
        echo json_encode($output);
    }

    public function deleteBoarddata(Request $request)
    {
        $boardId = $request->board_id;
    
        if (!is_null($boardId)) {
            $board = Board::find($boardId);
    
            if ($board) {
                $board->update(['board_status' => 'No']);
                //$board->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
                // Alternatively, you can return a JSON response:
                // return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Board not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid board ID'], 400);
        }
    }
    


}
