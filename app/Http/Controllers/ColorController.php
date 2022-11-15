<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin.color', $result);
    }

    public function manage_color(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Color::where(['id' => $id])->get();
            $result['color'] = $arr['0']->color;

            $result['id'] = $arr[0]->id;
        } else {

            $result['color'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_color', $result);

    }

    public function manage_color_process(Request $request)
    {
        $request->validate([
            // 'size' => 'required|integer',
            'color' => 'required|unique:colors,color,' . $request->post('id'),

        ]);
        if ($request->post('id') > 0) {
            $model = Color::find($request->post('id'));
            $message = "Color is Updated.";
        } else {
            $model = new Color();
            $message = "Color Added.";
        }

        // $model->size = $request->post('size');
        $model->color = $request->post('color');
        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/color');
    }

    public function delete(Request $request, $id)
    {
        $model = Color::find($id);
        $model->delete();
        $request->session()->flash('del', 'Color Deleted.');
        return redirect('admin/color');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Color::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Color Status is Updated.');
        return redirect('admin/color');
    }
}
