<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Board;
use App\Models\Medium;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Topic;
use App\Models\QuestionType;
use App\Models\QuestionBank;
use Session;
use Crypt;
use Validator;

class DashboardController extends Controller{

    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function index(Request $request){
        if(Auth::check()){
            $count = Board::count();
            $this->arr_view_data['board_count'] = $count;
            $count = Medium::count();
            $this->arr_view_data['medium_count'] = $count;
            $count = Standard::count();
            $this->arr_view_data['class_count'] = $count;
            $count = Subject::count();
            $this->arr_view_data['subject_count'] = $count;
            $count = Chapter::count();
            $this->arr_view_data['chapter_count'] = $count;
            $count = Topic::count();
            $this->arr_view_data['topic_count'] = $count;
            $count = QuestionType::count();
            $this->arr_view_data['question_type_count'] = $count;
            $count = QuestionBank::count();
            $this->arr_view_data['question_bank_count'] = $count;
            return view($this->module_view_folder.'.dashboard', $this->arr_view_data);
        }       
        return Redirect('/admin')->withErrors([
            'password' => 'Please login to access the dashboard.',
        ]);
    }

}