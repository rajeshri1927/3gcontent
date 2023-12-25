<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;

class SubjectController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(){
        $data['BoardList'] = Board::get(["board_name", "board_id"]);
        $data['BoardList'] = $data['BoardList'] ?? collect();
        return view($this->module_view_folder.'.subject', $this->arr_view_data,$data);
    }

    public function getClass(Request $request){
        $classList = Standard::where('medium_id',$request->medium_id)->get();
        $html = '';
        foreach ($classList as $classDet) {
            $html .= '<option value="' . $classDet->class_id . '">' . $classDet->class_name . '</option>';
        }        
        echo $html;
    }
}
