<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{

    public function index()
    {
        $result['data'] = Tax::all();
        return view('admin.tax', $result);
    }

    public function manage_tax($id = '')
    {
        if ($id > 0) {
            $arr = tax::where(['id' => $id])->get();
            $result['tax_desc'] = $arr['0']->tax_desc;
            $result['tax_value'] = $arr['0']->tax_value;

            $result['id'] = $arr[0]->id;
        } else {
            $result['tax_desc'] = '';
            $result['tax_value'] = '';

            $result['id'] = 0;

        }

        return view('admin/manage_tax', $result);

    }

    public function manage_tax_process(Request $request)
    {

        if ($request->post('id') > 0) {

            $model = Tax::find($request->post('id'));
            $message = "Tax is Updated.";
        } else {

            $model = new Tax();
            $message = "Tax Added.";
        }
        $request->validate([

            'tax_value' => 'required|unique:taxes,tax_value,' . $request->post('id'),

        ]);

        $model->tax_desc = $request->post('tax_desc');
        $model->tax_value = $request->post('tax_value');
        $model->status = 1;
        $model->save();
        $request->session()->flash('msg', $message);
        return redirect('admin/tax');
    }

    public function delete(Request $request, $id)
    {
        $model = Tax::find($id);
        $model->delete();
        $request->session()->flash('del', 'Tax is Delete.');
        return redirect('admin/tax');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Tax::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'Category Status is Updated.');
        return redirect('admin/tax');
    }
}
