<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = Order::query();
        $page = $request->get('page');
        $name = $request->get('name');
        $query->orderBy('created_at', 'desc');

        if ($name) {
            $params['name'] = $name;
            $query->where('customer_name', 'LIKE', '%' . $name . '%');
            $query->orWhere('customer_phone', 'LIKE', '%' . $name . '%');
            $query->orWhere('customer_email', 'LIKE', '%' . $name . '%');
        }
        if ($page) {
            $params['page'] = $page;
            $query->offset(ceil($page - 1) * 5);
        }

        $data['listOrders'] = $query->paginate(5);
        $data['params'] = $params;
        return view('backend.order.list', $data);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $data['order'] = $order;
        return view('backend.order.edit', $data);

    }

    public function update(Request $request, $id)
    {
        $data['customer_name'] = $request->name;
        $data['customer_phone'] = $request->phone;
        $data['customer_email'] = $request->email;
        $data['customer_address'] = $request->address;
        $data['note'] = $request->note;
        $data['status'] = $request->status;

        $order = Order::find($id);

        $order->update($data);
        return redirect()->intended('admin/order')->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function detail(Request $request, $id)
    {
        $data = [];
        $data['order'] = Order::find($id);
        $query = OrderDetail::query();
        $query->select('order_details.*');
        $query->join('orders as B', 'B.id', '=', 'order_details.order_id');
        $query->where('order_details.order_id', $id);
        $data['detail'] = $query->get();
        return view('backend.order.detail', $data);
    }
}

