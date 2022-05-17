<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopkeeperModel;
use App\Models\Dealeritem;
use App\Models\ItemModel;
use App\Models\DealerModel;
use App\Models\Customer;
use App\Models\Sales;

class ShopController extends Controller
{
    public function create()
    {
        return view('shopkeeperlogin');
    }

    public function show()
    {
        return view('addadmin');
    }

    public function store(Request $request)
    {
        $s=new ShopkeeperModel();
        $s->s_mail=$request->input('email');
        $s->s_pass=$request->input('password');
        $s->save();
    }

    public function check(Request $request)
    {
        //return $request->input();
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $userInfo = ShopkeeperModel::where('s_mail','=', $request->email)->first();

        if(!$userInfo){
            //echo("no user");
            return back()->with('fail','We do not recognize your email address');
        }else{
            //check password
            if($request->password==$userInfo->s_pass){
                //echo("sucess");
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/shopdashboard');
            }
            else{
                return back()->with('fail','Incorrect password');
            }
        }

    }

    public function dashboard() 
    {
        $cust=Customer::all();
        $c_count=count($cust);

        $sale=Sales::all();
        $s_count=count($sale);

        $item=Dealeritem::where('di_status','=', 'sold')->get();
        $i_count=count($item);
        
        $deal=DealerModel::all();
        $d_count=count($deal);

        $purchase = Dealeritem::where('di_status','!=', 'pending')->sum('di_price');

        $cash = Dealeritem::where('di_status', 'stockout')->sum('view_price');

        $cash2 = Dealeritem::where('di_status', 'stockout')->sum('di_price');

        $profit = $cash-$cash2;

        return view('dashindex')->with('c_count',$c_count)->with('s_count',$s_count)->with('i_count',$i_count)->with('d_count',$d_count)->with('purchase',$purchase)->with('cash',$cash)->with('profit',$profit);
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/');
        }
    }
    
    public function dealer(){
        $data1=Dealeritem::where('di_status','=', 'pending')->get();
        $data2=Dealeritem::join("dealer_models","dealer_models.id","=","dealeritems.d_id")
        ->where('dealeritems.di_status','!=', 'pending')
        ->select('dealeritems.id','dealeritems.di_name','dealeritems.di_desc','dealeritems.di_price','dealeritems.view_price','dealer_models.d_name','dealeritems.di_image','dealeritems.d_id')
        ->get();
        return view('shopdealer')->with('data1',$data1)->with('data2',$data2);
    }

    //display purchase of dealer item to the shopkeeper
    public function detail($id,$d_id)
    {
        $di = Dealeritem::where('id','=', $id)->first();
        $dealer= DealerModel::where('id','=', $d_id )->first();
        return view('shoppurchase')->with('di',$di)->with('dealer',$dealer);
    }

    
}
