<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Events\CustomerOrdered;
use Session;
use Auth;
use Cart;
use Validator;

class CustomerController extends Controller
{
    public function login()
    {
        return view('website.customer.login');
    }

    public function customerLogin(Request $request)
    {

        $arr = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => '1',
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::guard('customers')->attempt($arr, $remember)) {
            return redirect('/');
        } else {
            return back()->withInput()->with('error', 'Tài khoản, mật khẩu không chính xác hoặc chưa được kích hoạt');
        }
    }

    public function logout(Request $request)
    {
        Session::remove(Auth::guard('customers')->getName());
        return redirect('/');
    }

    public function edit()
    {
        if (Auth::guard('customers')->check()) {
            $id = Auth::guard('customers')->user()->id;
            $data['account'] = Customer::find($id);
            return view('website.customer.customer', $data);
        } else
            return redirect('/');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $arr['name'] = $request->name;
        $arr['phone'] = $request->phone;
        $arr['address'] = $request->email;
        $arr['password'] = bcrypt($request->password);

        $account = Customer::find($id);

        $account->update($arr);

        return redirect()->intended('')->with('success', 'Cập nhật thông tin tài khoản thành công');
    }

    public function register()
    {
        return view('website.customer.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:customers',
                'password' => 'required|string|min:5|confirmed',
            ],
            [
                'name.required' => 'Name can not be null',
                'name.max' => "Name's length must be < 255 characters",
                'email.required' => 'Email can not be null',
                'email.email' => 'Email must include @, for example: example@gmail.com',
                'email.max' => "Email's length must be < 255 characters",
                'email.unique' => 'Email was existed',
                'password.required' => 'Password can not be null',
                'password.min' => "Password's length must include at least 5 characters",
                'password.confirmed' => 'Password does not match',
            ]
        );
    }

    public function customerRegister(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->save();
        $user[] = [
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
        ];
        Session::put('user_info', $user);

        return redirect('/');
    }

    public function order()
    {
        $query = Order::query();
        if (Auth::guard('customers')->check()) {
            $id = Auth::guard('customers')->user()->id;
            $query->select('orders.*');
            $query->join('customers as C', 'C.id', '=', 'orders.customer_id');
            $query->where('customer_id', $id);
            $query->orderBy('created_at', 'DESC');
            $data['listOrders'] = $query->get();
            return view('website.customer.order', $data);
        } else
            return redirect('/');
    }

    public function orderDetail(Request $request, $id)
    {
        $data = [];
        $data['order'] = Order::find($id);
        $query = OrderDetail::query();
        $query->select('order_details.*', 'B.status as status');
        $query->join('orders as B', 'B.id', '=', 'order_details.order_id');
        $query->where('order_details.order_id', $id);
        $data['detail'] = $query->get();
        return view('website.customer.orderdetail', $data);
    }

    public function customerOder(Request $request)
    {
        $carts = Cart::content();
        if ($carts) {
            $order = new Order();
            if (Auth::guard('customers')->check()) {
                $order->customer_id = Auth::guard('customers')->user()->id;
            }
            $order->customer_name = $request->get('name');
            $order->customer_phone = $request->get('phone');
            $order->customer_email = $request->get('email');
            $order->customer_address = $request->get('address');
            $order->total_price = str_replace(',', '', Cart::total());

            if ($order->save()) {
                if ($request->get('email')) {
                    event(new CustomerOrdered($order));
                }

                foreach ($carts as $product) {
                    //insert item into orderdetails tb
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $product->id;
                    $orderDetail->product_name = $product->name;
                    $orderDetail->product_price = $product->price;
                    $orderDetail->quantity = $product->qty;
                    $orderDetail->subtotal = $product->subtotal;
                    $orderDetail->save();
                }
                return view('website.order_success');
            }
        }
    }
}
