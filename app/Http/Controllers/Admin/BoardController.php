<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Board;
use Validator;

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

    public function getBoarddata(){
        $boards = Board::select('*')->orderBy('board_id','asc')->get();
        echo json_encode($boards);
    }
    
    public function addBoard(Request $request){
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
                    'board_status' => $request->get('board_status')
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
                        'board_status' => $request->get('board_status')
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

    function fetchBoarddata(Request $request)
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
            $board = Board::where('board_id', $boardId)->first();

            if ($board) {
                $board->delete();
                echo '<div class="alert alert-success">Data Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Board not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid board ID'], 400);
        }
    }


}
