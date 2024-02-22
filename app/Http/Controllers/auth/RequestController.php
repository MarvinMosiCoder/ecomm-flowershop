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
use App\Models\Vouchers;
use App\Models\UsersVouchers;
use App\Models\Orders;
use App\Models\OrderLines;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RequestController extends Controller{
    private const Pending  = 1;
    public function addToCart(Request $request){
        $data = $request->all();
        $prodId = $data['inv_id'];
        $price = DB::table('inventory_tbl')->where('id',$prodId)->first()->price;
        $quantity = $data['quantity'];
        $prod_check = InventoryModel::where('id',$prodId)->exists();
        $standard_shipping = DB::table('standard_shippings')->select('*')->first();
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
                    $cartItem->prod_id           = $prodId;
                    $cartItem->user_id           = Auth::id();
                    $cartItem->quantity          = $quantity;
                    $cartItem->price             = $quantity * $price;
                    $cartItem->standard_shipping = $standard_shipping->current_standard_shipping;
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
        $data['my_all_address'] = UsersAddresses::address(Auth::id());
        $data['payment_type'] = PaymentTypeModel::select('*')->where('status','ACTIVE')->get();
        $data['vouchers'] = Vouchers::select('*')->get();
        $myVouchers = UsersVouchers::select('voucher_id AS voucher_id')->where('user_id', Auth::id())->get()->toArray();
        $data['my_vouchers'] = array_column($myVouchers, 'voucher_id');
        $data['isUsedVouchers'] = UsersVouchers::select('voucher_id AS voucher_id')->where('user_id', Auth::id())->whereNotNull('is_used')->count();
        return view('user-frontend.views.checkout',$data);
    }

    public function selectedAddress(Request $request){
        $data = $request->all();
        $id = $data['selectedId'];
        $res = UsersAddresses::addressSelected($id);
        return response()->json(['items'=> $res]);
    }

    public function getVouchersApplied(Request $request){
        $data = $request->all();
        $value = (int)$data['subTotalValue'];
        $zeroMinSpend = UsersVouchers::select('*','vouchers.id as v_id')
                    ->leftjoin('vouchers','users_vouchers.voucher_id','vouchers.id')
                    ->where('users_vouchers.user_id',  Auth::id())
                    ->whereNotNull('users_vouchers.is_used')
                    ->where('vouchers.status', 'ACTIVE')
                    ->where('users_vouchers.status', 'ACTIVE')  
                    ->where('vouchers.min_spend', 0)  
                    ->first();
        $requiredMinSpend = UsersVouchers::select('*','vouchers.id as v_id')
                    ->leftjoin('vouchers','users_vouchers.voucher_id','vouchers.id')
                    ->where('users_vouchers.user_id', Auth::id())
                    ->whereNotNull('users_vouchers.is_used')
                    ->where('vouchers.status', 'ACTIVE')
                    ->where('users_vouchers.status', 'ACTIVE')  
                    ->where('vouchers.min_spend', '!=', 0)
                    ->where('vouchers.min_spend', '<',$value)  
                    ->first();
        $isFreeShippingZeroMinSpendActive = UsersVouchers::select('*','vouchers.id as v_id')
                    ->leftjoin('vouchers','users_vouchers.voucher_id','vouchers.id')
                    ->where('users_vouchers.user_id',  Auth::id())
                    ->whereNotNull('users_vouchers.is_used')
                    ->where('vouchers.status', 'ACTIVE')
                    ->where('users_vouchers.status', 'ACTIVE')  
                    ->where('vouchers.min_spend', 0)  
                    ->first();
        if($isFreeShippingZeroMinSpendActive){
            $res = $zeroMinSpend;
        }else{
            $res = $requiredMinSpend;
        }
   
        return response()->json(['items'=> $res]);
    }

    public function submitPayment(Request $request){
        $data = $request->all();
        $latestOrder = Orders::orderBy('created_at','DESC')->first();
        $standard_shipping = DB::table('standard_shippings')->select('*')->first();
        $tracking_number = Str::random(11);
        $orders_id = Orders::insertGetId([
            'order_number'        => '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT),
            'tracking_number'     => $tracking_number,
            'status'              => self::Pending,
            'user_id'             => Auth::id(),
            'drop_address'        => $data['address_id'],
            'payment_method'      => $data['payment_type'],
            'subtotal'            => $data['sub_total'],
            'shipping'            => $standard_shipping->current_standard_shipping,
            'shipping_discounts'  => $data['shipping'],
            'overall_total'       => $data['overall_total'],
            'order_date'          => date('Y-m-d H:i:s'),
            'payment_time'        => NULL,
            'shipment_date'       => NULL,
            'delivery_date'       => NULL,
            'created_at'          => date('Y-m-d H:i:s')
        ]);
     
        foreach($data['cart_id'] as $val){
            $cart_detail = DB::table('add_to_cart_tbl')->where('id',$val)->first();
            OrderLines::insert([
                'order_id'          => $orders_id,
                'product_id'        => $val,
                'quantity'          => $cart_detail->quantity,
                'subtotal'          => $cart_detail->price,
                'shipping_standard' => $cart_detail->standard_shipping,
                'shipping_discount' => $data['shipping'],
                'created_at'        => date('Y-m-d H:i:s')
            ]);
            DB::table('add_to_cart_tbl')->where('id', $val)->delete();
        }
        $res = ['status'=>'success','msg'=>'Success!'];
		return json_encode($res);
    }
}
 