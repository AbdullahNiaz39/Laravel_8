<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin.size', $result);
    }

    public function manage_size(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Size::where(['id' => $id])->get();
            $result['size'] = $arr['0']->size;

            $result['id'] = $arr[0]->id;
        } else {
            $result['size'] = '';

            $result['id'] = 0;
        }
        return view('admin/manage_size', $result);

    }

    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required|alpha',

        ]);
        if ($request->post('id') > 0) {
            $model = Size::find($request->post('id'));
            $message = "Size is Updated.";
        } else {
            $model = new Size();
            $message = "Size Added.";
        }

        $model->size = $request->post('size');
        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/size');
    }

    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('del', 'Size Deleted.');
        return redirect('admin/size');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Size::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Size Status is Updated.');
        return redirect('admin/size');
    }
}
