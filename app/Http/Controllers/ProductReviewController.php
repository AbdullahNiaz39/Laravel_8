<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index(Request $request){

        $result['product_review'] = DB::table('product_review')
        ->leftjoin('customers', 'customers.id', '=', 'product_review.customers_id')
        ->leftjoin('products', 'products.id', '=', 'product_review.products_id')
        ->select('product_review.status','product_review.rating','product_review.review','product_review.id',
        'product_review.added_on','customers.name','products.name as pname')->get();
        //  prx($result);
        return view('admin.product_review',$result);

    }

    public function update_product_review_status(Request $request,$status,$id)
    {
        DB::table('product_review')
        ->where(['id'=>$id])->update(['status'=>$status]);
        return redirect('/admin/product_review');

    }

}
