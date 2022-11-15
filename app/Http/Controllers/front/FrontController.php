<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\HomeBanner;
use App\Models\products_attr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {

        $result['home_categories'] = Category::where(['status' => '1'])->where(['is_home' => '1'])->get();
        foreach ($result['home_categories'] as $list) {
            $result['home_categories_product'][$list->id] = DB::table('products')->where(['status' => 1])->where(['category_id' => $list->id])->get();

            foreach ($result['home_categories_product'][$list->id] as $list1) {
                $result['home_product_attr'][$list1->id] = DB::table('products_attrs')
                    ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                    ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                    ->where(['products_attrs.product_id' => $list1->id])->get();

            }
        }
        $result['home_brand'] = DB::table('brands')->where(['status' => '1'])->where(['is_home' => '1'])->get();

        $result['home_featured_product'][$list->id] = DB::table('products')->where(['status' => '1'])->where(['is_featured' => '1'])->get();

        foreach ($result['home_featured_product'][$list->id] as $list1) {
            $result['home_featured_product_attr'][$list1->id] = DB::table('products_attrs')
                ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                ->where(['products_attrs.product_id' => $list1->id])->get();

        }

        $result['home_trending_product'][$list->id] = DB::table('products')->where(['status' => '1'])->where(['is_trending' => '1'])->get();

        foreach ($result['home_trending_product'][$list->id] as $list1) {
            $result['home_trending_product_attr'][$list1->id] = DB::table('products_attrs')
                ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                ->where(['products_attrs.product_id' => $list1->id])->get();

        }

        $result['home_discounted_product'][$list->id] = DB::table('products')->where(['status' => '1'])->where(['is_discounted' => '1'])->get();

        foreach ($result['home_discounted_product'][$list->id] as $list1) {
            $result['home_discounted_product_attr'][$list1->id] = DB::table('products_attrs')
                ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                ->where(['products_attrs.product_id' => $list1->id])->get();
        }
        $result['home_banner'] = HomeBanner::where(['status' => '1'])->get();

        return view('front.index', $result);
    }
    public function product($slug)
    {
        $result['product'] = DB::table('products')->where(['status' => '1'])->where(['slug' => $slug])->get();

        foreach ($result['product'] as $list1) {
            $result['product_attr'][$list1->id] = DB::table('products_attrs')
                ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                ->where(['products_attrs.product_id' => $list1->id])->get();
        }

        foreach ($result['product'] as $list1) {
            $result['product_images'][$list1->id] = DB::table('product_images')
                ->where(['product_images.product_id' => $list1->id])->get();
        }

        $result['related_product'] = DB::table('products')->where(['status' => '1'])->where('slug', '!=', $slug)->where(['category_id' => $result['product'][0]->category_id])->get();
        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] = DB::table('products_attrs')
                ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
                ->where(['products_attrs.product_id' => $list1->id])->get();
        }
        $result['product_review'] = DB::table('product_review')
        ->leftjoin('customers', 'customers.id', '=', 'product_review.customers_id')
        ->where(['product_review.status'=>1])
        ->where(['product_review.products_id' => $result['product'][0]->id])->
        select('product_review.rating','product_review.review',
        'product_review.added_on','customers.name')->get();
        return view('front.product', $result);
    }
    public function add_to_cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

        $result = DB::table('products_attrs')
            ->select(['products_attrs.id'])
            ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
            ->where(['product_id' => $product_id])
            ->where(['sizes.size' => $size_id]
            )->where(['colors.color' => $color_id])->get();
        $product_attr_id = $result[0]->id;

        $getAvaliableQty=getAvaliableQty( $product_id,$product_attr_id);
        $finalAvaliableQty=$getAvaliableQty[0]->pqty-$getAvaliableQty[0]->qty;

    if($pqty>$finalAvaliableQty){
        return response()->json(['msg' => "not_avaliable", 'data' => "Only $finalAvaliableQty Quatity Left", 'totalItem' => count($result)]);

    }

        $check = DB::table('cart')->where(['user_id' => $uid]
        )->where(['user_type' => $user_type])->where(['product_id' => $product_id])->where(['product_attr_id' => $product_attr_id])->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($pqty == 0) {
                DB::table('cart')->where(['id' => $update_id])->delete();
                $msg = "Removed";
            } else {
                DB::table('cart')->where(['id' => $update_id])->update(['qty' => $pqty]);
                $msg = "Updated";
            }

        } else {
            $check = DB::table('cart')->insertGetId([
                'user_id' => $uid,
                'user_type' => $user_type,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'qty' => $pqty,
                'added_on' => date('Y-m-d h:i:s'),
            ]);
            $msg = "Added";
        }
        $result = DB::table('cart')->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('products_attrs', 'products_attrs.id', '=', 'cart.product_attr_id')
            ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->select('cart.qty', 'products.name', 'products.image', 'sizes.size', 'colors.color', 'products.slug',
                'products_attrs.price', 'products.id as pid', 'products_attrs.id as attr_id', )->get();
        return response()->json(['msg' => $msg, 'data' => $result, 'totalItem' => count($result)]);
    }

    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }
        $result['list'] = DB::table('cart')->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('products_attrs', 'products_attrs.id', '=', 'cart.product_attr_id')
            ->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->select('cart.qty', 'products.name', 'products.image', 'sizes.size', 'colors.color', 'products.slug',
                'products_attrs.price', 'products.id as pid', 'products_attrs.id as attr_id', )
                ->orderBy('product_review.added_on','desc')
            ->get();

        return view('front.cart', $result);
    }

    public function category(Request $request, $slug)
    {
        $sort = "";
        $sort_text = "";
        $color_filter = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $colorFilterArr = [];
        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }

        $query = DB::table('products');
        $query = $query->leftjoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftjoin('products_attrs', 'products_attrs.product_id', '=', 'products.id');
        $query = $query->where(['products.status' => '1']);
        $query = $query->where(['categories.category_slug' => $slug]);
        if ($sort == 'name') {
            $query = $query->orderBy('products.name', 'desc');
            $sort_text = "Product Name";
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'asc');
            $sort_text = "Date";
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('products_attrs.price', 'desc');
            $sort_text = "Price - Desc";
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('products_attrs.price', 'asc');
            $sort_text = "Price - asc";
        }

        if ($request->get('filter_price_start') !== null &&
            $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');
            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $query = $query->whereBetween('products_attrs.price', [$filter_price_start, $filter_price_end]);
            }
        }
        if ($request->get('color_filter') !== null) {
            $color_filter = $request->get('color_filter');
            $colorFilterArr = explode(":", $color_filter);

            $query = $query->where(['products_attrs.color_id' => $request->get('color_filter')]);
            $color_filter = $request->get('color_filter');
        }
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;
        foreach ($result['product'] as $list1) {
            $query = DB::table('products_attrs');
            $query = $query->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id');
            $query = $query->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id');
            $query = $query->where(['products_attrs.product_id' => $list1->id]);

            $query = $query->get();
            $result['product_attr'][$list1->id] = $query;
        }

        $result['categories_left'] = Category::where(['status' => '1'])
            ->get();

        $result['colors'] = Color::where(['status' => '1'])->get();
        $result['sort'] = $sort;
        $result['slug'] = $slug;
        $result['sort_text'] = $sort_text;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;
        return view('front.category', $result);
    }

    public function search($str)
    {

        $query = DB::table('products');
        $query = $query->leftjoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftjoin('products_attrs', 'products_attrs.product_id', '=', 'products.id');
        $query = $query->where(['products.status' => '1']);
        $query = $query->where('name', 'like', "%$str%");
        $query = $query->orwhere('keywords', 'like', "%$str%");
        $query = $query->orwhere('desc', 'like', "%$str%");
        $query = $query->orwhere('brand', 'like', "%$str%");
        $query = $query->orwhere('model', 'like', "%$str%");
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;
        foreach ($result['product'] as $list1) {
            $query = DB::table('products_attrs');
            $query = $query->leftjoin('sizes', 'sizes.id', '=', 'products_attrs.size_id');
            $query = $query->leftjoin('colors', 'colors.id', '=', 'products_attrs.color_id');
            $query = $query->where(['products_attrs.product_id' => $list1->id]);

            $query = $query->get();
            $result['product_attr'][$list1->id] = $query;
        }

        $result['colors'] = Color::where(['status' => '1'])->get();

        return view('front.search', $result);
    }

    public function registration(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN') != null) {
            return redirect('/');
        } else {
            return view('front.registration');
        }

    }
    public function registration_process(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6',
            'confirm' => 'required|same:password',
            'mobile' => 'required|numeric|regex:/(03)[0-9]{9}/',
            'email' => 'required|email|unique:customers,email',
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
        } else {
            $rand = rand(111111111, 999999999);
            $arr = [
                'name' => $request->name,
                'password' => Crypt::encrypt($request->password),
                'mobile' => $request->mobile,
                'email' => $request->email,
                'status' => 1,
                'is_verify' => 0,
                'rand_id' => $rand,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ];
            $query = DB::table('customers')->insert($arr);
            if ($query) {
                $data = ['name' => $request->name, 'rand_id' => $rand];
                $user['to'] = $request->email;
                Mail::send('front/email_verification', $data, function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('Email Id verification');
                });
                return response()->json(['status' => 'success', 'msg' => "Registration success, Please check your email id for verification"]);
            }
        }

    }

    public function login_process(Request $request)
    {

        $result = DB::table('customers')
            ->where(['email' => $request->str_login_email])->get();
        if (isset($result[0])) {
            $db_pwd = Crypt::decrypt($result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_verify;
            if ($is_verify == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Please verify your email']);
            }
            if ($status == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Your account has been deactivitate']);
            }
            if ($db_pwd == $request->str_login_password) {
                if ($request->rememberme === null) {
                    setcookie('login_email', $request->str_login_email, 100);
                    setcookie('login_password', $request->str_login_password, 100);
                } else {
                    setcookie('login_email', $request->str_login_email, time() + 60 * 60 * 24 * 365);
                    setcookie('login_password', $request->str_login_password, time() + 60 * 60 * 24 * 365);
                }
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $status = "success";
                $msg = "";
                $getUserTempId = getUserTempId();
                Db::table('cart')
                    ->where(['user_id' => $getUserTempId])
                    ->where(['user_type' => 'Not-Reg'])
                    ->update(['user_id' => $result[0]->id, 'user_type' => 'Reg',
                    ]);

            } else {
                $status = "error";
                $msg = "Please enter valid passwords";
            }

        } else {
            $status = "error";
            $msg = "Please Enter valid email id";
        }

        return response()->json(['status' => $status, 'msg' => $msg]);

    }

    public function email_verification($id)
    {
        $result = Db::table('customers')->where(['rand_id' => $id])
            ->where(['is_verify' => 0])
            ->get();
        if (isset($result[0])) {
            Db::table('customers')->where(['id' => $result[0]->id])
                ->update(['is_verify' => 1, 'rand_id' => '']);
            return view('front.verification');
        } else {
            return redirect('/');
        }
    }

    public function forgot_password(Request $request)
    {
        $rand_id = rand(111111111, 999999999);
        $result = DB::table('customers')
            ->where(['email' => $request->str_forgot_email])->get();
        if (isset($result[0])) {
            Db::table('customers')
                ->where(['email' => $request->str_forgot_email])
                ->update(['is_forgot_password' => 1, 'rand_id' => $rand_id]);
            $data = ['name' => $result[0]->name, 'rand_id' => $rand_id];
            $user['to'] = $request->str_forgot_email;
            Mail::send('front/forgot_email', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Forgot Password');
            });
            return response()->json(['status' => 'success', 'msg' => "Please check your email id for password"]);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Email id is not Registered']);
        }

    }

    public function forgot_password_change(Request $request, $id)
    {
        $result = Db::table('customers')->where(['rand_id' => $id])
            ->where(['is_forgot_password' => 1])
            ->get();
        if (isset($result[0])) {
            $request->session()->put('FROGOT_PASSWORD_USER_ID', $result[0]->id);
            return view('front.forgot_password_change');
        } else {
            return redirect('/');
        }
    }
    public function forgot_password_change_process(Request $request)
    {
        Db::table('customers')
            ->where(['id' => $request->session()->get('FROGOT_PASSWORD_USER_ID')])
            ->update(['is_forgot_password' => 0, 'rand_id' => '', 'password' => Crypt::encrypt($request->password),
            ]);
        return response()->json(['status' => 'success', 'msg' => "Password has been Changed"]);

    }
    public function checkout(Request $request)
    {
        $result['cart_data'] = getAddToCartTotalItem();
        if (isset($result['cart_data'][0])) {

            if ($request->session()->has('FRONT_USER_LOGIN')) {
                $uid = $request->session()->get('FRONT_USER_ID');
                $customer_info = Db::table('customers')
                    ->where(['id' => $uid])->get();
                $result['customers']['name'] = $customer_info[0]->name;
                $result['customers']['email'] = $customer_info[0]->email;
                $result['customers']['mobile'] = $customer_info[0]->mobile;
                $result['customers']['address'] = $customer_info[0]->address;
                $result['customers']['city'] = $customer_info[0]->city;
                $result['customers']['zip'] = $customer_info[0]->zip;
                $result['customers']['state'] = $customer_info[0]->state;

            } else {

                $result['customers']['name'] = '';
                $result['customers']['email'] = '';
                $result['customers']['mobile'] = '';
                $result['customers']['address'] = '';
                $result['customers']['city'] = '';
                $result['customers']['zip'] = '';
                $result['customers']['state'] = '';

            }
            return view('front.checkout', $result);
        } else {
            return redirect('/');
        }
    }

    public function apply_coupon_code(Request $request)
    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true);

        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'totalPrice' => $arr['totalPrice']]);
    }

    public function remove_coupon_code(Request $request)
    {
        $totalPrice = 0;
        $result = DB::table('coupons')
            ->where(['code' => $request->coupon_code])->get();
        $getAddToCartTotalItem = getAddToCartTotalItem();
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }

        return response()->json(['status' => 'success', 'msg' => 'Coupon Code removed', 'totalPrice' => $totalPrice]);

    }

    public function place_order(Request $request)
    {
        $payment_url = '';
        $rand = rand(111111111, 999999999);
        if ($request->session()->has('FRONT_USER_LOGIN')) {

        }else{
            $valid = Validator::make($request->all(), [
                'email' => 'required|email|unique:customers,email',
            ]);
            if ($valid->fails()) {
                return response()->json(['status' => 'error', 'msg' => 'The email has already been taken.']);
            }else{

                $arr = [
                    'name' => $request->name,
                    'password' => Crypt::encrypt($rand),
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'email' => $request->email,
                    'status' => 1,
                    'is_verify' => 1,
                    'rand_id' => $rand,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'is_forgot_password'=>0

                ];
                $user_id = DB::table('customers')->insertGetId($arr);



$request->session()->put('FRONT_USER_LOGIN', true);
$request->session()->put('FRONT_USER_ID', $user_id);
$request->session()->put('FRONT_USER_NAME', $request->name);
  ///        verify password////
                // $data = ['name' => $request->name, 'password' => $rand];
                // $user['to'] = $request->email;
                // Mail::send('front/password_send', $data, function ($messages) use ($user) {
                //     $messages->to($user['to']);
                //     $messages->subject('Your Account Password');
                // });
$getUserTempId = getUserTempId();
Db::table('cart')
    ->where(['user_id' => $getUserTempId])
    ->where(['user_type' => 'Not-Reg'])
    ->update(['user_id' => $user_id, 'user_type' => 'Reg',
    ]);
     }
        }
            $coupon_value = 0;
            if ($request->coupon_code != '') {
                $arr = apply_coupon_code($request->coupon_code);
                $arr = json_decode($arr, true);
                if ($arr['status'] == 'success') {
                    $coupon_value = $arr['coupon_code_val'];
                } else {
                    return response()->json(['status' => 'false', 'msg' => $arr['msg']]);
                }

            }

            $uid = $request->session()->get('FRONT_USER_ID');
            $totalPrice = 0;
            $getAddToCartTotalItem = getAddToCartTotalItem();

            foreach ($getAddToCartTotalItem as $list) {
                $totalPrice = $totalPrice + ($list->qty * $list->price);

            }
            $arr = [
                'name' => $request->name,
                'email' => $request->email,
                'customers_id' => $uid,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'coupon_code' => $request->coupon_code,
                'coupon_value' => $coupon_value,
                'order_status' => 1,
                'payment_type' => $request->payment_type,
                'payment_status' => "Pending",
                'total_amt' => $totalPrice,
                'added_on' => date('Y-m-d H:i:s'),
            ];

            $orders_id = DB::table('orders')->insertGetId($arr);
            $productDetailArr = [];
            if ($orders_id > 0) {
                foreach ($getAddToCartTotalItem as $list) {
                    $totalPrice = $totalPrice + ($list->qty * $list->price);
                    $productDetailArr['products_id'] = $list->pid;
                    $productDetailArr['price'] = $list->price;
                    $productDetailArr['products_attrs_id'] = $list->attr_id;
                    $productDetailArr['qty'] = $list->qty;
                    $productDetailArr['orders_id'] = $orders_id;
                    DB::table('orders_detail')->insertGetId($productDetailArr);
                }
                if ($request->payment_type == 'Gateway') {
                    $final_amt = $totalPrice - $coupon_value;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array("X-Api-Key:test_c96727a8265389950803b726e54",
                            "X-Auth-Token:test_84aadd5c5a1dee93c4a113414b7")
                    );
                    $payload = array(
                        'purpose' => 'Buy Product',
                        'amount' => $final_amt,
                        'phone' => $request->mobile,
                        'buyer_name' => $request->name,
                        'redirect_url' => 'http://127.0.0.1:8000/instamojo_payment_redirect',
                        'send_email' => true,
                        'send_sms' => true,
                        'email' => $request->email,
                        'allow_repeated_payments' => false,
                    );
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response = json_decode($response);
                    $txn_id = $response->payment_request->id;
                    DB::table('orders')->where(['id' => $orders_id])->update(['txn_id' => $txn_id]);
                    // $payment_url = $response->payment_request->longurl;
                    //7:11
                    // if (isset($response->payment_request->id)) {
                    //     $txn_id = $response->payment_request->id;
                    //     DB::table('orders')
                    //         ->where(['id' => $order_id])
                    //         ->update(['txn_id' => $txn_id]);
                    //     $payment_url = $response->payment_request->longurl;
                    // }
                }
                DB::table('cart')->where(['user_id' => $uid, 'user_type' => 'Reg'])->delete();
                $request->session()->put('ORDER_ID', $orders_id);
                $status = 'success';
                $msg = 'Order Placed Successfully';
            } else {
                $status = 'false';
                $msg = 'Please try after sometime';
            }
        // } else {
        //     $status = 'false';
        //     $msg = 'Please Login to place order';
        // }
        return response()->json(['status' => $status, 'msg' => $msg,
            'payment_url' => $payment_url]);

    }
    public function order_place(Request $request)
    {

        if ($request->session()->has('ORDER_ID')) {
            return view('front.order_place');
        } else {
            return redirect('/');

        }

    }
    public function instamojo_payment_redirect(Request $request)
    {

        dd($_GET);

    }

    public function order(Request $request)
    {
        $result['orders']=DB::table('orders')
        ->select('orders.*','orders_status.order_status')
        ->leftjoin('orders_status', 'orders_status.id', '=', 'orders.order_status')
        ->where(['orders.customers_id' => $request->session()->get('FRONT_USER_ID')])->get();

        return view('front.order',$result);

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
        ->where(['orders.id' => $id])
        ->where(['orders.customers_id' => $request->session()->get('FRONT_USER_ID')])->get();
            if(!isset($result['orders_detail'][0])){
                return redirect('/');
            }
        return view('front.order_detail',$result);

    }

    public function product_review_process(Request $request)
    {
         if($request->session()->has('FRONT_USER_LOGIN')){
             $uid=$request->session()->get('FRONT_USER_ID');

             $arr = [
                'rating' => $request->rating,
                'review' => $request->review,
                'products_id' => $request->products_id,
                'status' => 1,
                'customers_id' => $uid,
                'added_on' => date('Y-m-d H:i:s'),

            ];
            DB::table('product_review')->insert($arr);
            $status="success";
             $msg="Thank you for providing your review";
        }else{
                     $status="error";
                     $msg="Please login to submit your review";
                    }
                    return response()->json(['status'=>$status,'msg'=>$msg]);
    }


}




