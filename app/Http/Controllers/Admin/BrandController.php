<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = Brand::query();
        $name = $request->get('name');
        $query->orderBy('id', 'desc');
        if ($name) {
            $params['name'] = $name;
            $query->where('brands.name', 'LIKE', '%' . $name . '%');
        }

        $data['brands'] = $query->paginate(5);
        $data['params'] = $params;

        return view('backend.brand.list', $data);
    }

    public function create()
    {
        return view('backend.brand.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:brands',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable',
        ]);

        $brand = new Brand;
        if ($request->hasFile('logo')) {
            $fileName = $request->logo->getClientOriginalName();
            $request->logo->storeAs('brands', $fileName);
            $brand->logo = $fileName;
        }

        $brand->name = $request->name;
        $brand->slug = str_slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status;

        $brand->save();

        return redirect()->intended('admin/brand')->with("success", "Thêm thành công");
    }

    public function edit($id)
    {
        $data['brands'] = Brand::find($id);
        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'unique:brands' . $id,
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable',
        ]);

        $arr['name'] = $request->name;
        $arr['slug'] = str_slug($request->name);
        $arr['description'] = $request->description;
        $arr['status'] = $request->status;

        if ($request->hasFile('logo')) {
            $img = $request->logo->getClientOriginalName();
            $arr['logo'] = $img;
            $request->logo->storeAs('brands', $img);
        }

        $brand = Brand::find($id);
        $brand->update($arr);

        return redirect()->intended('admin/brand')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->delete();
            return back()->with('success', 'Xóa thành công');
        }
    }
}
