<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use Validator;
use DataTables;

class MediumController extends Controller
{

    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index()
    {
        $count = Medium::count();
        $this->arr_view_data['medium_count'] = $count;
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.medium', $this->arr_view_data,$data);
    }

    public function getMediumAllData(){
        $build_result = array();
        $mediums = Medium::select('medium_details.medium_id', 'medium_details.medium', 'medium_details.medium_status', 'medium_details.created_on', 'medium_details.modified_on', 'board_details.board_id','board_details.board_name')
        ->join('board_details', 'medium_details.board_id', '=', 'board_details.board_id')
        ->orderBy('medium_details.medium_id', 'asc')
        ->latest();
        $json_result = DataTables::of($mediums)
        ->addColumn('built_action_btns', function ($data) {
            $updateButton = '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->medium_id.'" data-toggle="modal" title="Update Medium Details"><i class="fas fa-edit"></i></button>';
            $deleteButton = '<button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->medium_id.'" data-toggle="modal" name="button" title="Delete Medium Details"><i class="fas fa-trash-alt"></i></button>';
            return '<input type="checkbox" class="selectCheckbox" data-medium-id="'.$data->medium_id.'">' . $updateButton . $deleteButton;
        })->make(true);
		$build_result = $json_result->getData();

        if (isset($build_result->data) && sizeof($build_result->data) > 0) {
            $i = 0;
            foreach ($build_result->data as $key => $data) {
                $i = $i + 1;
                $delete = '<input type="checkbox" class="selectmediumCheckbox" data-medium-id="'.$data->medium_id.'">';
                $build_result->data[$key]->delete = $delete;
                $build_result->data[$key]->medium_id  = $data->medium_id;
                $build_result->data[$key]->board_name = $data->board_name;
                $build_result->data[$key]->medium = $data->medium;
                $build_result->data[$key]->medium_status = $data->medium_status;
                $build_result->data[$key]->created_at = date("d M Y", strtotime($data->created_on));
                $action = '<button name="button" class="btn btn-sm btn-warning mt-1 update" type="button" data-id="'.$data->medium_id.'" data-toggle="modal"  title="Update Topic Details"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mt-1 ml-2 delete" id="delete" type="button" data-id="'.$data->medium_id.'" data-toggle="modal"   name="button" title="Delete Topic Details"><i class="fas fa-trash-alt"></i></button>';
				$build_result->data[$key]->built_action_btns = $action;
            }
            return response()->json($build_result);
        } else {
            return response()->json($build_result);
        }
 
    }

    public function addMedium(Request $request){
        $user = Auth::user();
        $validation = Validator::make($request->all(), [
            'medium'  => 'required'
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
                $medium = new Medium([
                    'medium_id'     => strtoupper(substr(uniqid("med"."_".md5(uniqid("medium", true))), 0,15)),
                    'medium'        => $request->get('medium_name'),
                    'board_id'      => $request->get('board_id'),
                    'medium_status' => $request->get('medium_status'),
                    'created_by'    => $user->emp_name,
                    'creation_ip'   => $_SERVER['REMOTE_ADDR']
                ]);
                $medium->save();
                $success_output = '<div class="alert alert-success">Medium Data Added Successfully!! </div>';
            }
            if ($request->get('button_action') == 'update') {
                $medium = Medium::find($request->get('medium_id'));
            
                if ($medium) {
                    $medium->update([
                        'medium' => $request->get('medium'),
                        'board_id' => $request->get('board_id'),
                        'medium_status' => $request->get('medium_status'),
                        'modified_by' => $user->name,
                        'modified_ip' => $_SERVER['REMOTE_ADDR']
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

    public function updateGetMediumData(Request $request)
    {
        $medium_id  = $request->input('medium_id');
        $medium     = Medium::where('medium_id',$medium_id)->first();
        $output     = array(
            'medium'        =>  $medium->medium,
            'board_id'      =>  $medium->board_id,
            'medium_status' =>  $medium->medium_status
        );
        echo json_encode($output);
    }
    
    public function deleteMediumData(Request $request)
    {
        $mediumId = $request->medium_id;

        if (!is_null($mediumId)) {
            $medium = Medium::find($mediumId);

            if ($medium) {
                $medium->update(['medium_status' => 'InActive']);
                echo '<div class="alert alert-success">Medium Deleted</div>';
                //return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Medium not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Medium ID'], 400);
        }
    }

    public function deleteMultipleMediumData(Request $request)
    {
        $ids = $request->input('medium_ids');
        if (is_string($ids) && !empty($ids)) {
            // Convert comma-separated string to an array
            $mediumIdsArray = explode(',', $ids);
            // Remove any empty values
            $mediumIdsArray = array_filter($mediumIdsArray);
            if (!empty($mediumIdsArray)) {
                // Perform the delete operation based on the provided IDs
                Medium::whereIn('medium_id', $mediumIdsArray)->delete();
                echo '<div class="alert alert-success">All Medium Deleted.</div>';
            } else {
                return response()->json(['error' => 'Invalid or empty board_ids provided'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid or empty board_ids provided'], 400);
        }
    }

}
