<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\classesManagement;
use App\Models\Medium;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Subject;

use Validator;

use Illuminate\Http\Request;

class ClassesManagementController extends Controller
{
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(){
      $data['BoardList'] = Board::get(["board_name", "board_id"]);
      $data['BoardList'] = $data['BoardList'] ?? collect();
      return view($this->module_view_folder.'.classesManage', $this->arr_view_data,$data);
    }
}
