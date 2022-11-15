<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data'] = Customer::all();
        return view('admin.customer', $result);
    }
    public function show($id)
    {
        $model['data'] = Customer::find($id);
        return view('admin/show_customer', $model);

    }

    public function delete(Request $request, $id)
    {
        $model = Customer::find($id);
        $model->delete();
        $request->session()->flash('del', 'Customer Deleted.');
        return redirect('admin/customer');
    }
    public function status(Request $request, $type, $id)
    {
        $model = Customer::find($id);
        $model->status = $type;
        $model->save();
        $request->session()->flash('del', 'customer Status is Updated.');
        return redirect('admin/customer');
    }
}
