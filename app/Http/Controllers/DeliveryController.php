<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\feeShip;
use App\Town;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $districts = District::all();
        $towns = Town::all();
        return view('admin.delivery.index',compact('cities','districts','towns'));
    }
    public function select(Request $request)
    {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "city"){
                $select_district = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output .= '<option hidden>---Chọn quận huyện---</option>';
                foreach($select_district as $valD){
                    $output.='<option value="'.$valD->maqh.'">'.$valD->name.'</option>';
                }
            }else{
                $select_town = Town::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output .= '<option hidden>---Chọn xã phường---</option>';
                foreach($select_town as $valT){
                    $output.='<option value="'.$valT->xaid.'">'.$valT->name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function store(Request $request)
    {
        feeShip::create([
            'matp' => $request ->matp,
            'maqh' => $request->maqh,
            'xaid' => $request->xaid,
            'fee_feeship' => $request->fee_feeship,
        ]);
        return redirect()->back();
    }    
}
