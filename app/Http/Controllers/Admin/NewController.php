<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = NewDetail::query();
        $page = $request->get('page');
        $name = $request->get('name');
        $query->orderBy('id', 'DESC');
        if ($name) {
            $params['name'] = $name;
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($page) {
            $params['page'] = $page;
            $query->offset(ceil($page - 1) * 5);
        }
        $data['listNews'] = $query->paginate(5);
        $data['params'] = $params;
        return view('backend.new.list', $data);
    }

    public function create()
    {
        return view('backend.new.add');
    }

    public function store(Request $request)
    {
        $new = new NewDetail();
        if ($request->hasFile('image')) {
            $fileName = time() . $request->image->getClientOriginalName();
            $request->image->storeAs('news', $fileName);
            $new->image = $fileName;
        }

        $new->name = $request->name;
        $new->slug = str_slug($request->name);
        $new->description = $request->description;
        $new->content = $request->content;
        $new->status = $request->status;

        $new->save();

        return redirect()->intended('admin/new')->with('success', 'Thêm tin tức thành công');
    }

    public function edit($id)
    {
        $new = NewDetail::find($id);
        $data['new'] = $new;
        return view('backend.new.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $arr['name'] = $request->name;
        $arr['slug'] = str_slug($request->name);
        $arr['description'] = $request->description;
        $arr['content'] = $request->content;
        $arr['status'] = $request->status;

        if ($request->hasFile('image')) {
            $img = time() . $request->image->getClientOriginalName();
            $arr['image'] = $img;
            $request->image->storeAs('news', $img);
        }

        $new = NewDetail::find($id);

        if ($new) {
            $new->update($arr);
            return redirect()->intended('admin/new')->with('success', 'Sửa thành công');
        }
    }

    public function destroy($id)
    {
        $new = NewDetail::find($id);
        if ($new) {
            $new->delete();
            return back()->with('success', 'Xóa thành công');
        }
    }
}
