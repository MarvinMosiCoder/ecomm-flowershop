<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use DB;
use App\Models\InventoryModel;
use App\Models\AddToCartModel;
use App\Models\UsersAddresses;
use App\Models\PaymentTypeModel;
use Auth;
use Illuminate\Support\Facades\Redirect;

class RequestController extends Controller{

    public function addToCart(Request $request){
        $data = $request->all();
    
        $prodId = $data['inv_id'];
        $price = DB::table('inventory_tbl')->where('id',$prodId)->first()->price;
        $quantity = $data['quantity'];
        $prod_check = InventoryModel::where('id',$prodId)->exists();
        if(Auth::check()){
            if($prod_check){
                if (AddToCartModel::where('prod_id', $prodId)->where('user_id', Auth::id())->exists()) {
                    AddToCartModel::where('prod_id', $prodId)->where('user_id', Auth::id())->update([
                        'quantity'=> DB::raw("quantity + $quantity"),
                        'price'=> DB::raw("price + $price")
                    ]);
                    $countCart = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
                    return response()->json(['status'=>'success','msg'=>'Add to cart successfully!','count'=> $countCart]);
                }else{
                    $cartItem = new AddToCartModel();
                    $cartItem->prod_id  = $prodId;
                    $cartItem->user_id  = Auth::id();
                    $cartItem->quantity = $quantity;
                    $cartItem->price    = $quantity * $price;
                    $cartItem->save();
    
                    $countCart = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
                    return response()->json(['status'=>'success','msg'=>'Add to cart successfully!','status'=>'success','count'=> $countCart]);
                }
            }
        }else{
            return response()->json(['status'=>'error','redirect_url'=>route('login.perform')]);
        }
        
        
    }

    public function removeToCart(Request $request){
        $data = $request->all();
        $id = $data['id'];
        AddToCartModel::where('id', $id)->where('user_id', Auth::id())->delete();
        $countCart = AddToCartModel::select('*')->where('user_id', Auth::id())->count();
        return response()->json(['status'=>'success','msg'=>'Remove cart item!','count'=> $countCart]); 
    }

    public function addQtyCart(Request $request){
        $data = $request->all();
        $prodId = $data['id'];
        $quantity = 1;

        $productDetail = AddToCartModel::select('*')->where('id', $prodId)->where('user_id', Auth::id())->first();
        $addPrice = InventoryModel::where('id',$productDetail->prod_id)->first()->price;
        AddToCartModel::where('id', $prodId)->where('user_id', Auth::id())->update([
            'quantity'=> DB::raw("quantity + $quantity"),
            'price'=> DB::raw("price + $addPrice")
        ]);

        $item = AddToCartModel::select('*')->where('id', $prodId)->where('user_id', Auth::id())->first();
        return response()->json(['status'=>'success','msg'=>'Add cart qty item!','item'=> $item]);
    }

    public function lessQtyCart(Request $request){
        $data = $request->all();
        $prodId = $data['id'];
        $quantity = 1;

        $productDetail = AddToCartModel::select('*')->where('id', $prodId)->where('user_id', Auth::id())->first();
        $addPrice = InventoryModel::where('id',$productDetail->prod_id)->first()->price;
        AddToCartModel::where('id', $prodId)->where('user_id', Auth::id())->update([
            'quantity'=> DB::raw("quantity - $quantity"),
            'price'=> DB::raw("price - $addPrice")
        ]);

        $item = AddToCartModel::select('*')->where('id', $prodId)->where('user_id', Auth::id())->first();
        return response()->json(['status'=>'success','msg'=>'Less cart cart item!','item'=> $item]);
    }

    public function submitCheckoutCart(Request $request){
        $data = [];
        $req = $request->all();
        $ids = $req['cart_id'];
        $data['my_cart_detail'] = AddToCartModel::cartDetail($ids,Auth::id());
        $data['my_address'] = UsersAddresses::addressDefault(Auth::id());
        $data['payment_type'] = PaymentTypeModel::select('*')->where('status','ACTIVE')->get();
        return view('user-frontend.views.checkout',$data);
    }

}
 