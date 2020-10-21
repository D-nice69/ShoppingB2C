<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite

session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if($admin_id){
            return redirect()->route('Admin.showDashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    public function index(){
        $admin_id = Session::get('id');
        if($admin_id){
            return redirect()->route('Admin.showDashboard');
        }else{
            return view('admin.adminLogin');
        }
    }
    public function showDashboard(){
        $this->AuthLogin();
    	return view('admin.adminDashboard');
    }
    public function adminLogin(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    	if($result){
            $result_count = $result->count();
            if($result_count>0){
                Session::put('admin_name',$result->admin_name);
                Session::put('id',$result->id);
                return redirect()->route('Admin.showDashboard');
            }
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại');
            return Redirect::to('/admin');
        }

    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('id',null);
        return Redirect::to('/admin');
    }
    
    //login facebook
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Admin::where('id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('id',$account_name->id);
            return redirect()->route('Admin.showDashboard');
        }else{

            $dung = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Admin::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Admin::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',

                ]);
            }
            $dung->login()->associate($orang);
            $dung->save();

            $account_name = Admin::where('id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
            Session::put('id',$account_name->id);
            return redirect('/admin/dashboard');
        } 
    }
    //--end login facebook

    //login google
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Admin::where('id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('id',$account_name->id);
        return redirect()->route('Admin.showDashboard');
    }

    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
      
        $dung = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Admin::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Admin::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
        $dung->login()->associate($orang);
        $dung->save();

        $account_name = Admin::where('id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('id',$account_name->id);
        return redirect('/admin/dashboard');
    }
    //--end login google

}
