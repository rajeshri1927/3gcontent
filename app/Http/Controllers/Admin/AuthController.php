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
use DB;

class AuthController extends Controller{
    
    public function __construct(){
        $this->arr_view_data = [];
        $this->module_view_folder = 'admin';
    }

    public function login(Request $request){
        return view($this->module_view_folder.'.login', $this->arr_view_data);
    }

    public function register(Request $request){
        $nonceValue = encryptFormData();
        $this->arr_view_data['nonceVal'] = $nonceValue;
        return view($this->module_view_folder.'.registration', $this->arr_view_data);
    }

    public function submitSignUpForm(Request $request){
        /* $validation = Validator::make($request->all(), [
            'username'  => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (!$validation->fails()) {
            // $nonceValue = encryptFormData();
            $data_obj = User::where('role_id', 1)->first();
            if(isset($data_obj->name)){
                $role_id = 2;
            } else {
                $role_id = 1;
            }            
            $userArr = array('role_id' => $role_id,
                             'name' => $request->username,
                             'email' => $request->email,
                             'password' => Hash::make($request->password),
                             'status' => 1);
            User::create($userArr);
            echo '1';
        } else {
            echo '0';
        } */
        $validation = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data_obj = User::where('role_id', 1)->first();
        if(isset($data_obj->name)){
            $role_id = 2;
        } else {
            $role_id = 1;
        }
        $data = array('role_id' => $role_id,
                      'name' => $request->username,
                      'email' => $request->email,
                      'password' => Hash::make($request->password),
                      'status' => 1);
        User::create($data);
        return Redirect("admin")->withSuccess('You have register');
    }

    public function authenticateUser(Request $request){
        /* $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            echo '1';
        } else {
            echo '0';
        } */
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->withSuccess('Signed in');
        } else {
            return back()->withErrors([
                'password' => 'Login details are not valid.',
            ]);
        }
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('admin');
    }
}