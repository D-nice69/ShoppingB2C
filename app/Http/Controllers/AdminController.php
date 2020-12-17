<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Seller;
use Illuminate\Support\Facades\Redirect;
use App\Social; //sử dụng model Social
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Socialite; //sử dụng Socialite

session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if($admin_id){
            return redirect()->route('Admin.showDashboard');
        }else{
            return Redirect::to('home')->send();
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
        $c = Session::get('CustomerId');       
        if($c){
            return view('admin.adminDashboard');
        }else{
            $this->AuthLogin();
            return view('admin.adminDashboard');
        }
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
        Auth::logout();
        Session::put('admin_name',null);
        Session::put('id',null);
        Session::put('CustomerName',null);
        Session::put('CustomerId',null);
    }
    
    //login facebook
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account!=Null){
            //login in vao trang quan tri  
            $account_name = Customer::where('id',$account->user)->first();
            Auth::attempt(['email' => $account_name->email, 'password' => 'password']);
            Session::put('CustomerName',$account_name->name);
            Session::put('CustomerId',$account_name->id);
            Session::put('CustomerRole',$account_name->role_id);
            return redirect()->route('home.index');
        }elseif($account==null){

            $dung = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $customer = Customer::where('email',$provider->getEmail())->first();

            if(!$customer){
                $customer = Customer::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => md5('password'),
                    'phone' => '',
                    'role_id' => '2',
                    'is_verified' => '1'
                ]);
                Auth::attempt(['email' => $customer->email, 'password' => 'password']);
                Seller::create([
                    'customer_id' => $customer->id,
                    'shop_info' => '',
                    'shop_name' => $customer->name,
                ]);
            }
        } 
        $dung->login()->associate($customer);
        $dung->save();

        $account_name = Customer::where('id',$dung->user)->first();
        Auth::attempt(['email' => $account_name->email, 'password' => 'password']);
        Session::put('CustomerName',$account_name->name);
        Session::put('CustomerId',$account_name->id);
        Session::put('CustomerRole',$account_name->role_id);
        return redirect()->route('home.index');
    }
    //--end login facebook

    //login google
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google(){
        $provider = Socialite::driver('google')->stateless()->user();
        $account = Social::where('provider','google')->where('provider_user_id',$provider->getId())->first();
        if($account!=Null){
            $account_name = Customer::where('id',$account->user)->first();
            Auth::attempt(['email' => $account_name->email, 'password' => 'password']);
            Session::put('CustomerName',$account_name->name);
            Session::put('CustomerId',$account_name->id);
            Session::put('CustomerRole',$account_name->role_id);
            return redirect()->route('home.index');
        }elseif($account==null){

            $dung = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google'
            ]);

            $customer = Customer::where('email',$provider->getEmail())->first();

            if(!$customer){
                $customer = Customer::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => md5('password'),
                    'phone' => '',
                    'role_id' => '2',
                    'is_verified' => '1'
                ]);
                Auth::attempt(['email' => $customer->email, 'password' => 'password']);
                Seller::create([
                    'customer_id' => $customer->id,
                    'shop_info' => '',
                    'shop_name' => $customer->name,
                ]);
            }
        } 
        $dung->login()->associate($customer);
        $dung->save();

        $account_name = Customer::where('id',$dung->user)->first();
        Auth::attempt(['email' => $account_name->email, 'password' => 'password']);
        Session::put('CustomerName',$account_name->name);
        Session::put('CustomerId',$account_name->id);
        Session::put('CustomerRole',$account_name->role_id);
        return redirect()->route('home.index');
    }

    // public function findOrCreateUser($users,$provider){
    //     $authUser = Social::where('provider_user_id', $users->id)->first();
    //     if($authUser){

    //         return $authUser;
    //     }
      
    //     $dung = new Social([
    //         'provider_user_id' => $users->id,
    //         'provider' => strtoupper($provider)
    //     ]);

    //     $orang = Admin::where('admin_email',$users->email)->first();

    //         if(!$orang){
    //             $orang = Admin::create([
    //                 'admin_name' => $users->name,
    //                 'admin_email' => $users->email,
    //                 'admin_password' => '',
    //                 'admin_phone' => '',
    //             ]);
    //         }
    //     $dung->login()->associate($orang);
    //     $dung->save();

    //     $account_name = Admin::where('id',$authUser->user)->first();
    //     Session::put('admin_name',$account_name->admin_name);
    //     Session::put('id',$account_name->id);
    //     return redirect('/admin/dashboard');
    // }
    //--end login google

}
