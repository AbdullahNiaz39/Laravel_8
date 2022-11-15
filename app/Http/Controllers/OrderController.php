<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request){

        $result['order']=DB::table('orders')
        ->select('orders.*','orders_status.order_status')
        ->leftjoin('orders_status', 'orders_status.id','=', 'orders.order_status')
        ->get();
       // prx($result);
        return view('admin.order',$result);
    
    }
    public function order_detail(Request $request,$id)
    {
        $result['orders_detail']= DB::table('orders_detail')
        ->select('orders.*',
        'orders_detail.price','orders_detail.qty','products.name as pname',
        'products_attrs.attr_image','sizes.size','colors.color','orders_status.order_status')
        ->leftjoin('orders', 'orders.id', '=', 'orders_detail.orders_id')
        ->leftjoin('orders_status', 'orders_status.id', '=', 'orders.order_status')
        ->leftjoin('products_attrs', 'products_attrs.id', '=', 'orders_detail.products_attrs_id')
        ->leftjoin('products', 'products.id', '=', 'products_attrs.product_id')
        ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
        ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
        ->where(['orders.id' => $id])->get();
        $result['payment_status']=['Pending','Success','Fail'];
        $result['order_status']=DB::table('orders_status')->get();
        return view('admin.order_detail',$result);

    }
    public function update_payment_status(Request $request,$payment_status,$id)
    {
        DB::table('orders')
        ->where(['id'=>$id])->update(['payment_status'=>$payment_status]);
        return redirect('/admin/order_detail/'.$id);

    }
    public function update_order_status(Request $request,$order_status,$id)
    {
        DB::table('orders')
        ->where(['id'=>$id])->update(['order_status'=>$order_status]);
        return redirect('/admin/order_detail/'.$id);

    }

    public function update_track_detail(Request $request,$id)
    {
        echo '220';
        $track_detail=$request->post('track_detail');
        DB::table('orders')
        ->where(['id'=>$id])->update(['track_detail'=>$track_detail]);
        return redirect('/admin/order_detail/'.$id);
    }
}
