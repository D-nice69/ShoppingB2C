<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(5);       
        $roles = Role::get();
        return view('admin.customer.index',compact('customers','roles'));
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        $roleCustomer = Role::where('id',$customer->role_id)->first();
        $roles = Role::get();
        return view('admin.customer.edit',compact('customer','roleCustomer','roles'));
    }
    public function update($id, Request $request)
    {
        $updateCustomer = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
        ];
        Customer::find($id)->update($updateCustomer);
        toastr()->success('Phân quyền người dùng thành công');
        return redirect()->route('adminCustomer.index');
    }
    public function delete($id)
    {
        Customer::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail',
        ],500);
    }
}
