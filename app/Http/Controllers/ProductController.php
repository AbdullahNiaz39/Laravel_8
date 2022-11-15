<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\products_attr;
use App\Models\Size;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin.product', $result);
    }

    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Product::where(['id' => $id])->get();
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['category_id'] = $arr['0']->category_id;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_specs'] = $arr['0']->technical_specs;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['slug'] = $arr['0']->slug;
            $result['id'] = $arr[0]->id;
            $result['status'] = $arr[0]->status;

            $result['lead_time'] = $arr[0]->lead_time;
            $result['tax_id'] = $arr[0]->tax_id;
            $result['is_promo'] = $arr[0]->is_promo;
            $result['is_featured'] = $arr[0]->is_featured;
            $result['is_discounted'] = $arr[0]->is_discounted;
            $result['is_trending'] = $arr[0]->is_trending;

            $result["prods_Attr"] = products_attr::where(['product_id' => $id])->get();
            $prod_images = DB::table('product_images')->where(['product_id' => $id])->get();

            if (!isset($prod_images[0])) {
                $result['prod_images'][0]['id'] = '';
                $result['prod_images'][0]['images'] = '';
            } else {
                $result['prod_images'] = $prod_images;
            }
        } else {
            $result['name'] = '';
            $result['image'] = '';
            $result['category_id'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specs'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['slug'] = '';
            $result['id'] = 0;
            $result['lead_time'] = '';
            $result['tax_id'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_trending'] = '';

            //Product Attribute
            $result['prods_Attr'][0]['id'] = 0;
            $result['prods_Attr'][0]['sku'] = '';
            $result['prods_Attr'][0]['qty'] = '';
            $result['prods_Attr'][0]['price'] = '';
            $result['prods_Attr'][0]['attr_image'] = '';
            $result['prods_Attr'][0]['mrp'] = '';
            $result['prods_Attr'][0]['color_id'] = '';
            $result['prods_Attr'][0]['size_id'] = '';
            $result['prods_Attr'][0]['product_id'] = '';

            ///for images//
            $result['prod_images'][0]['id'] = '';
            $result['prod_images'][0]['images'] = '';

        }
        $result["categorys"] = Category::where(['status' => 1])->get();
        $result["sizes"] = Size::where(['status' => 1])->get();
        $result["colors"] = Color::where(['status' => 1])->get();
        $result["brands"] = Brand::where(['status' => 1])->get();
        $result["taxes"] = Tax::where(['status' => 1])->get();
        return view('admin/manage_product', $result);

    }

    public function manage_product_process(Request $request)
    {

        if ($request->post('id') > 0) {
            $image_validation = 'mimes:png,jpg,jpeg';
            $model = Product::find($request->post('id'));
            $message = "Product is Updated.";
        } else {
            $image_validation = 'required|mimes:png,jpg,jpeg';
            $model = new Product();
            $message = "Product Added.";
        }
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'image' => $image_validation,
            'attr_image.*' => 'mimes:png,jpg,jpeg',
            'images.*' => 'mimes:png,jpg,jpeg',
            'mrp.*' => 'required|numeric',
            'price.*' => 'required|numeric',
            'qty.*' => 'required|numeric',
        ]);
///sku validation
        $skuArr = $request->post('sku');
        $paidArr = $request->post('paid');
        foreach ($skuArr as $key => $val) {
            $check = products_attr::where('sku', '=', $skuArr[$key])->where('id', '!=', $paidArr[$key])->get();
            if (isset($check[0])) {
                $request->session()->flash('sku_error', $skuArr[$key] . ' Sku already exists');
                return redirect(request()->headers->get('referer'));
            }
        }
        if ($request->hasFile('image')) {
            if ($request->post('id') > 0) {
                $arrimage = DB::table('products')->where(['id' => $request->post('id')])->get();
                $destination = public_path('admin_assets/images/' . $arrimage[0]->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->move(public_path('admin_assets/images/'), $image_name);
            $model->image = $image_name;
        }

        $model->name = $request->post('name');
        $model->category_id = $request->post('category_id');
        $model->slug = $request->post('slug');
        $model->model = $request->post('model');
        $model->brand = $request->post('brand');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->technical_specs = $request->post('technical_specs');
        $model->keywords = $request->post('keywords');
        $model->warranty = $request->post('warranty');
        $model->uses = $request->post('uses');
        $model->lead_time = $request->post('lead_time');
        $model->tax_id = $request->post('tax_id');
        $model->is_promo = $request->post('is_promo');
        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->is_trending = $request->post('is_trending');
        $model->status = 1;
        $model->save();
        $pid = $model->id;
        ///Product attr is Start

        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');
        $imgArr = $request->post('attr_image');
        foreach ($skuArr as $key => $val) {
            $prods_Attr = [];
            $prods_Attr['product_id'] = $pid;
            $prods_Attr['price'] = (int) $priceArr[$key];

            $prods_Attr['mrp'] = (int) $mrpArr[$key];
            $prods_Attr['qty'] = (int) $qtyArr[$key];
            $prods_Attr['sku'] = $skuArr[$key];
            if ($size_idArr[$key] == '') {
                $prods_Attr['size_id'] = 0;
            } else {
                $prods_Attr['size_id'] = $size_idArr[$key];
            }
            if ($color_idArr[$key] == '') {
                $prods_Attr['color_id'] = 0;
            } else {
                $prods_Attr['color_id'] = $color_idArr[$key];
            }
///product image upload in array form
            if ($request->hasFile("attr_image.$key")) {
                if ($paidArr[$key] > 0) {
                    $arrimage = DB::table('products_attrs')->where(['id' => $paidArr[$key]])->get();
                    $destination = public_path('admin_assets/images/' . $arrimage[0]->attr_image);
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                }
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = uniqid() . '.' . $ext;
                $request->file("attr_image.$key")->move(public_path('admin_assets/images/'), $image_name);
                $prods_Attr['attr_image'] = $image_name;
            }
            if ($paidArr[$key] > 0) {
                DB::table('products_attrs')->where(['id' => $paidArr[$key]])->update($prods_Attr);

            } else {

                DB::table('products_attrs')->insert($prods_Attr);

            }
        }

        ////product_multiple_images///
        $piid = $request->post('piid');
        foreach ($piid as $key => $val) {
            $prods_images['product_id'] = $pid;
            if ($request->hasFile("images.$key")) {
                if ($piid[$key] > 0) {

                    $arrimage = DB::table('product_images')->where(['id' => $piid[$key]])->get();
                    $destination = public_path('admin_assets/images/' . $arrimage[0]->images);
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                }
                $p_images = $request->file("images.$key");
                $ext = $p_images->extension();
                $image_name = uniqid() . '.' . $ext;
                $request->file("images.$key")->move(public_path('admin_assets/images/'), $image_name);
                $prods_images['images'] = $image_name;

                if ($piid[$key] > 0) {
                    DB::table('product_images')->where(['id' => $piid[$key]])->update($prods_images);
                } else {
                    DB::table('product_images')->insert($prods_images);
                }
            }

        }
        ///product is end
        $request->session()->flash('msg', $message);
        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {

        $model = Product::find($id);
        $destination = public_path('admin_assets/images/' . $model->image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $model->delete();
        $request->session()->flash('del', 'Product is Delete.');
        return redirect('admin/product');
    }
    public function prod_attr_delete($id, $pid)
    {

        $model = products_attr::find($id);
        $destination = public_path('admin_assets/images/' . $model->attr_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $model->delete();
        return redirect('admin/product/manage_product/' . $pid);

    }
    public function prod_images_delete($id, $pid)
    {
        $arrimage = DB::table('product_images')->where(['id' => $id])->get();
        $destination = public_path('admin_assets/images/' . $arrimage[0]->images);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        DB::table('product_images')->where(['id' => $id])->delete();

        return redirect('admin/product/manage_product/' . $pid);

    }
    public function status(Request $request, $type, $id)
    {
        $model = Product::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Product Status is Updated.');
        return redirect('admin/product');
    }
}
