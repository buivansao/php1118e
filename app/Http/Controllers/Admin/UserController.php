<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = User::query();

        $name = $request->get('name');
        $query->where('level', 2);
        $query->orderBy('created_at', 'desc');
        if ($name) {
            $params['name'] = $name;
            $query->where('user_name', 'LIKE', '%' . $name . '%');
            $query->orWhere('user_email', 'LIKE', '%' . $name . '%');
        }

        $data['listAccounts'] = $query->paginate(2);
        $data['params'] = $params;

        return view('backend.account.list', $data);
    }

    public function create()
    {
        return view('backend.account.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:255',
            'user_email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $account = new User();
        $account->user_name = $request->user_name;
        $account->user_email = $request->user_email;
        $account->password = bcrypt($request->password);
        $account->status = $request->status;

        $account->save();

        return redirect()->intended('admin/account')->with("success", "Thêm tài khoản thành công");
    }

    public function disable(Request $request, User $user)
    {
        $user->fill($request->only('status'));
        $user->status = $request->status;
        $user->save();
        return back()->with('success', 'Hủy kích hoạt thành công');
    }

    public function enable(Request $request, User $user)
    {
        $user->fill($request->only('status'));
        $user->status = $request->status;
        $user->save();
        return back()->with('success', 'Kích hoạt thành công');
    }
}

