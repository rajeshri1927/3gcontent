<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\Modules;
use Session;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if(isset($user->roleId) && $user->roleId != 2){
            if(Session::has('adminUserDetail')){
                Session::put('adminUserDetail',$user);
                $this->adminUser = $user;
                return $next($request);
            }else{
                return redirect(url('/admin'));
            }
        }else{
            Session::flash('deactive', 'You have entered wrong credentials');
            return redirect(url('/admin'));
        }
    }
}
