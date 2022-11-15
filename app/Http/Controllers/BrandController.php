<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $result['data'] = Brand::all();
        return view('admin.brand', $result);
    }

    public function manage_brand(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Brand::where(['id' => $id])->get();
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr[0]->id;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = "";
            if ($arr['0']->is_home == 1) {
                $result['is_home_selected'] = "checked";
            }
        } else {
            $result['name'] = '';
            $result['is_home'] = '';
            $result['is_home_selected'] = '';
            $result['image'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_brand', $result);

    }

    public function manage_brand_process(Request $request)
    {

        if ($request->post('id') > 0) {

            $model = Brand::find($request->post('id'));

            $message = "Brand is Updated.";
            $image_validation = 'mimes:png,jpg,jpeg';
        } else {

            $model = new Brand();
            $message = "brand Added.";
            $image_validation = 'required|mimes:jpg,jpeg,png';
        }
        $request->validate([
            'image' => $image_validation,
            'name' => 'required|unique:brands,name,' . $request->post('id'),
        ]);

        $model->name = $request->post('name');
        if ($request->hasFile('image')) {
            if ($request->post('id') > 0) {
                $model = Brand::find($request->post('id'));
                $destination = public_path('admin_assets/images/' . $model->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = uniqid() . '.' . $ext;
            $image->move(public_path('admin_assets/images/'), $image_name);
            $model->image = $image_name;
        }
        $model->is_home = 0;
        if ($request->post('is_home') != null) {
            $model->is_home = 1;
        }
        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/brand');
    }

    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $destination = public_path('admin_assets/images/' . $model->image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $model->delete();
        $request->session()->flash('del', 'Brand is Delete.');
        return redirect('admin/brand');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Brand::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Brand Status is Updated.');
        return redirect('admin/brand');
    }
}
