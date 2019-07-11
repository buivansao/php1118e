<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductOption;
use App\Models\ProductImage;
use App\Models\ProductRelate;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $data = $params = [];
        $query = Product::query();
        $page = $request->get('page');
        $name = $request->get('name');
        $query->orderBy('id', 'desc');
        if ($name) {
            $params['name'] = $name;
            $query->where('products.name', 'LIKE', '%' . $name . '%');
        }
        if ($page) {
            $params['page'] = $page;
            $query->offset(ceil($page - 1) * 5);
        }
        $data['products'] = $query->paginate(5);
        $data['params'] = $params;
        return view('backend.product.list', $data);
    }

    public function create()
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        $data['brands'] = Brand::all();
        return view('backend.product.add', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => "unique:products|max:255",
            'slug' => 'unique:products',
            'description' => 'nullable',
            'stock_price' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'brand_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $product = new Product;
        if ($request->hasFile('image')) {
            $fileName = time() . $request->image->getClientOriginalName();
            $product->image = $fileName;
            $request->image->storeAs('products', $fileName);
        }

        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->stock_price = $request->stock_price;
        $product->price = $request->price;
        $product->content = $request->content;
        $product->stock = $request->stock;
        $product->status = $request->status;

        $product->save();

        $option = [];
        if (count($request->option_name) > 0 && count($request->option_value) > 0) {
            foreach ($request->option_name as $key1 => $name) {
                foreach ($request->option_value as $key2 => $value) {
                    if ($key1 == $key2) {
                        $option = [
                            'product_id' => $product->id,
                            'option_name' => $name,
                            'option_value' => $value,
                        ];
                    }
                }
                ProductOption::create($option);
            }
        }

        if ($request->hasFile('filename')) {
            foreach ($request->filename as $key => $image) {
                $img['product_id'] = $product->id;
                $fileName = time() . $image->getClientOriginalName();
                $img['image'] = $fileName;
                $img['position'] = $key;
                $image->storeAs('products', $fileName);
                ProductImage::create($img);
            }
        }

        if (isset($request->relate)) {
            $relate = [];
            foreach ($request->relate as $item) {
                $relate['product_id'] = $product->id;
                $relate['product_relate_id'] = $item;
                ProductRelate::create($relate);
            }
        }

        if (isset($request->category)) {
            $category = [];
            foreach ($request->category as $item) {
                $category['product_id'] = $product->id;
                $category['category_id'] = $item;
                ProductCategory::create($category);
            }
        }

        return redirect()->intended('admin/product')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $data['image'] = ProductImage::where('product_id', $id)->get();
        $data['brands'] = Brand::all();
        $data['product'] = Product::find($id);
        $data['options'] = ProductOption::where('product_id', $id)->get();

        $relate = Product::query();
        $relate->select('products.*', 'C.name as rName', 'B.id as rid', 'B.product_relate_id as sid');
        $relate->rightJoin('product_relates as B', 'products.id', '=', 'B.product_id');
        $relate->rightJoin('products as C', 'C.id', '=', 'B.product_relate_id');
        $relate->where('B.product_id', '=', $id);
        if (count($relate->get()) > 0) {
            $data['relate'] = $relate->get();
        }

        $category = Product::query();
        $category->select('products.*', 'C.name as cName', 'B.id as cid', 'B.category_id as cateid');
        $category->leftJoin('product_category as B', 'B.product_id', '=', 'products.id');
        $category->leftJoin('categories as C', 'C.id', '=', 'B.category_id');
        $category->where('B.product_id', '=', $id);

        if (count($category->get()) > 0) {
            $data['category'] = $category->get();
        }

        $data['listProducts'] = Product::all();
        $data['listCategories'] = Category::all();

        return view('backend.product.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|max:255",
            'slug' => 'unique:products' . $id,
            'description' => 'nullable',
            'stock_price' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'brand_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $arr = [];
        $arr['name'] = $request->name;
        $arr['slug'] = str_slug($request->name);
        $arr['description'] = $request->description;
        $arr['brand_id'] = $request->brand_id;
        $arr['stock_price'] = $request->stock_price;
        $arr['price'] = $request->price;
        $arr['content'] = $request->content;
        $arr['stock'] = $request->stock;
        $arr['status'] = $request->status;

        if ($request->hasFile('img')) {
            $fileName = time() . $request->img->getClientOriginalName();
            $arr['image'] = $fileName;
            $request->img->storeAs('products', $fileName);
        }

        ProductCategory::where('product_id', $id)->delete();

        if (isset($request->category)) {
            $category = [];
            foreach ($request->category as $item) {
                $category['product_id'] = $id;
                $category['category_id'] = $item;
                ProductCategory::create($category);
            }
        }

        ProductRelate::where('product_id', $id)->delete();
        if (isset($request->relate)) {
            $relate = [];
            foreach ($request->relate as $item) {
                $relate['product_id'] = $id;
                $relate['product_relate_id'] = $item;
                ProductRelate::create($relate);
            }
        }

        $option = [];
        ProductOption::where('product_id', $id)->delete();
        if (count($request->option_name) > 0 && count($request->option_value) > 0) {
            foreach ($request->option_name as $key1 => $name) {
                foreach ($request->option_value as $key2 => $value) {
                    if ($key1 == $key2) {
                        $option = [
                            'product_id' => $id,
                            'option_name' => $name,
                            'option_value' => $value,
                        ];
                    }
                }
                ProductOption::create($option);
            }
        }

        if ($request->hasFile('filename')) {
            foreach ($request->filename as $key => $image) {
                $img['product_id'] = $id;
                $fileName = time() . $image->getClientOriginalName();
                $img['image'] = $fileName;
                $img['position'] = $key;
                $image->storeAs('products', $fileName);
                ProductImage::create($img);
            }
        }

        $product = Product::findOrFail($id);
        if (!$product) {
            return redirect()->intended('admin/product');
        }

        $product->update($arr);
        return redirect()->intended('admin/product')->with('success', 'Sửa thành công');
    }

    public function destroy($id, $delete)
    {
        if ($delete == "deleterl") {
            $relate = ProductRelate::find($id);
            if ($relate) {
                $relate->delete();
                return back()->with('success', 'Xóa sản phẩm liên quan thành công');
            }
        } else if ($delete == 'deletecate') {
            $category = ProductCategory::find($id);
            if ($category) {
                $category->delete();
                return back()->with('success', 'Xóa danh mục thành công');
            }
        } else if ($delete == 'deleteop') {
            $option = ProductOption::find($id);
            if ($option) {
                $option->delete();
                return back()->with('success', 'Xóa thuộc tính thành công');
            }
        } else if ($delete == 'deleteimg') {
            $img = ProductImage::find($id);
            if ($img) {
                $img->delete();
                return back()->with('success', 'Xóa ảnh thành công');
            }
        } else if ($delete == 'delete') {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return back()->with('success', 'Xóa sản phẩm thành công');
            }
        }
    }

}
