<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];

        $query = Customer::query();
        $name = $request->get('name');

        if ($name) {
            $params['name'] = $name;
            $query->where('name', 'LIKE', '%' . $name . '%');
            $query->orWhere('email', 'LIKE', '%' . $name . '%');
            $query->orWhere('phone', 'LIKE', '%' . $name . '%');
        }

        $data['listCustomers'] = $query->paginate(2);
        $data['params'] = $params;

        return view('backend.customer.list', $data);
    }

    public function disable(Request $request, Customer $customer)
    {
        $customer->fill($request->only('status'));
        $customer->status = $request->status;
        $customer->save();
        return back()->with('success', 'Hủy kích hoạt thành công');
    }

    public function enable(Request $request, Customer $customer)
    {
        $customer->fill($request->only('status'));
        $customer->status = $request->status;
        $customer->save();
        return back()->with('success', 'Kích hoạt thành công');
    }
}

