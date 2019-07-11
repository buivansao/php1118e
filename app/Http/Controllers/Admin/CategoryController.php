<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\EditCateRequest;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = Category::query();
        $name = $request->get('name');
        $query->select('categories.*', 'B.name as pName', 'B.id as pId');
        $query->leftJoin('categories as B', 'categories.parent_id', '=', 'B.id');
        $query->limit(10);
        $query->orderBy('categories.id', 'DESC');
        $query->offset(0);

        if ($name) {
            $params['name'] = $name;
            $query->where('categories.name', 'LIKE', '%' . $name . '%');
        }

        $data['categories'] = $query->paginate(10);
        $data['params'] = $params;

        return view('backend.category.list', $data);
    }

    public function create()
    {
        $data['parents'] = Category::get();
        return view('backend.category.add', $data);
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->content = $request->content;
        $category->position = $request->position;
        $category->status = $request->status;

        $category->save();

        return redirect()->intended('admin/category')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $query = Category::query();
        $query->select('categories.*', 'B.name as pName');
        $query->leftJoin('categories as B', 'categories.parent_id', '=', 'B.id');
        $query->where('categories.id', '=', $id);

        $category = Category::find($id);
        if (!$category) {
            return redirect()->intended('admin/category');
        }

        $data['category'] = $category;
        $data['categories'] = Category::get();
        return view('backend.category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $arr['name'] = $request->name;
        $arr['slug'] = str_slug($request->name);
        $arr['description'] = $request->description;
        $arr['parent_id'] = $request->parent_id;
        $arr['content'] = $request->content;
        $arr['position'] = $request->position;
        $arr['status'] = $request->status;

        $category->update($arr);

        return redirect()->intended('admin/category')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return back()->with('success', 'Xóa thành công');
        }
    }
}
