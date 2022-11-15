<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeBannerController extends Controller
{
    public function index()
    {
        $result['data'] = HomeBanner::all();
        return view('admin.banner', $result);
    }

    public function manage_banner($id = '')
    {
        if ($id > 0) {
            $arr = HomeBanner::where(['id' => $id])->get();
            $result['image'] = $arr['0']->image;
            $result['btn_text'] = $arr['0']->btn_text;
            $result['btn_link'] = $arr['0']->btn_link;
            $result['id'] = $arr[0]->id;
        } else {
            $result['image'] = '';
            $result['btn_text'] = '';
            $result['btn_link'] = '';

            $result['id'] = 0;

        }

        return view('admin/manage_banner', $result);

    }

    public function manage_banner_process(Request $request)
    {

        if ($request->post('id') > 0) {
            $image_validation = 'mimes:png,jpg,jpeg';
            $model = HomeBanner::find($request->post('id'));
            $message = "Banner is Updated.";
        } else {
            $image_validation = 'required|mimes:png,jpg,jpeg';
            $model = new HomeBanner();
            $message = "banner Added.";
        }
        $request->validate([
            'image' => $image_validation,
        ]);
        if ($request->hasFile('image')) {
            if ($request->post('id') > 0) {
                $model = HomeBanner::find($request->post('id'));
                $destination = public_path('admin_assets/images/banner/' . $model->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->move(public_path('admin_assets/images/banner/'), $image_name);
            $model->image = $image_name;
        }
        $model->btn_text = $request->post('btn_text');
        $model->btn_link = $request->post('btn_link');
        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/banner');
    }

    public function delete(Request $request, $id)
    {
        $model = Homebanner::find($id);
        $model->delete();
        $request->session()->flash('del', 'Banner is Delete.');
        return redirect('admin/banner');
    }
    public function status(Request $request, $type, $id)
    {
        $model = HomeBanner::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Banner Status is Updated.');
        return redirect('admin/banner');
    }
}
