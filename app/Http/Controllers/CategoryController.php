<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        $result['data'] = Category::all();
        return view('admin.category', $result);
    }

    public function manage_category(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Category::where(['id' => $id])->get();
            $result['category_name'] = $arr['0']->category_name;
            $result['category_slug'] = $arr['0']->category_slug;
            $result['parent_category_id'] = $arr['0']->parent_category_id;
            $result['category_image'] = $arr['0']->category_image;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = "";
            if ($arr['0']->is_home == 1) {
                $result['is_home_selected'] = "checked";
            }
            $result['id'] = $arr[0]->id;
            $result["categorys"] = Category::where(['status' => 1])->where('id', '!=', $id)->get();
        } else {
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['parent_category_id'] = '';
            $result['category_image'] = '';
            $result['is_home'] = '';
            $result['is_home_selected'] = "";
            $result['id'] = 0;
            $result["categorys"] = Category::where(['status' => 1])->get();
        }

        return view('admin/manage_category', $result);

    }

    public function manage_category_process(Request $request)
    {

        if ($request->post('id') > 0) {
            $image_validation = 'mimes:png,jpg,jpeg';
            $model = Category::find($request->post('id'));
            $message = "Category is Updated.";
        } else {
            $image_validation = 'required|mimes:png,jpg,jpeg';
            $model = new Category();
            $message = "Category Added.";
        }
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,' . $request->post('id'),
            'category_image' => $image_validation,
        ]);

        if ($request->hasFile('category_image')) {
            if ($request->post('id') > 0) {
                $model = Category::find($request->post('id'));
                $destination = public_path('admin_assets/images/category/' . $model->category_image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $image = $request->file('category_image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->move(public_path('admin_assets/images/category/'), $image_name);
            $model->category_image = $image_name;
        }
        $model->is_home = 0;

        if ($request->post('is_home') != null) {
            $model->is_home = 1;
        }
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');

        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/category');
    }

    public function delete(Request $request, $id)
    {
        $model = Category::find($id);
        $destination = public_path('admin_assets/images/category/' . $model->category_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $model->delete();
        $request->session()->flash('del', 'Category is Delete.');
        return redirect('admin/category');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Category::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Category Status is Updated.');
        return redirect('admin/category');
    }
}
