<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
            return view($this->module_view_folder.'.dashboard', $this->arr_view_data);
        }       
        return Redirect('/admin')->withErrors([
            'password' => 'Please login to access the dashboard.',
        ]);
    }

}