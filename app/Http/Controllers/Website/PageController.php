<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductRelate;
use Illuminate\Http\Request;
use App\Http\Requests\PostCommentRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductReview;
use Cart;
use Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $hot = Product::query();
        $hot->select('products.*');
        $hot->leftJoin('product_category as B', 'B.product_id', '=', 'products.id');
        $hot->where('B.category_id', 9);
        $hot->where('products.status', 1);
        $data['hotProducts'] = $hot->paginate(8);

        $giare = Product::query();
        $giare->select('products.*');
        $giare->leftJoin('product_category as B', 'B.product_id', '=', 'products.id');
        $giare->where('B.category_id', 11);
        $giare->where('products.status', 1);
        $data['cheapProducts'] = $giare->paginate(8);

        $sock = Product::query();
        $sock->select('products.*');
        $sock->leftJoin('product_category as B', 'B.product_id', '=', 'products.id');
        $sock->where('B.category_id', 13);
        $sock->where('products.status', 1);
        $sock->orderBy('id', 'DESC');
        $data['sockProducts'] = $sock->paginate(4);

        $data['brands'] = Brand::all();
        if (!$request->name)
            return view('website.home', $data);
        else {
            $result = $request->input('name');
            $product = Product::query();
            if ($result) {
                $params['name'] = $result;
                $product->where('name', 'LIKE', "%$result%");
            }
            $data['products'] = $product->get();
            return view('website.search', $data);
        }
    }

    public function newList()
    {
        $data['listNews'] = NewDetail::paginate(5);
        return view('website.newlist', $data);
    }

    public function newDetail($slug)
    {
        $detail = NewDetail::where('slug', $slug)->first();
        if ($detail){
            $data['detail'] = NewDetail::find($detail->id);
            return view('website.newdetail', $data);
        }
        else return redirect('/');
    }

    public function show($slug)
    {
        $cate = Category::where('slug', $slug)->first();
        if($cate){
            $data['name'] = $cate->name;
            $products = Product::query();
            $products->select('products.*');
            if ($cate){
                $products->join('product_category as B', 'B.product_id', '=', 'products.id');
                $products->where('B.category_id', $cate->id);
            }
            $data['products'] = $products->paginate(12);
            return view('website.listProducts', $data);
        }
        else{
            return redirect('/');
        }
    }

    public function getDetail($slug)
    {
        $detail = Product::where('slug', $slug)->first();

        $relate = ProductRelate::query();
        $relate->select('A.*');
        $relate->join('products as A', 'A.id', '=', 'product_relates.product_relate_id');
        $relate->where('product_relates.product_id', $detail->id);
        $relate->limit(4);

        $data['item'] = $detail;
        $data['options'] = ProductOption::where('product_id', $detail->id)->get();
        $data['comments'] = ProductReview::where('product_id', $detail->id)->get();
        $data['imgs'] = ProductImage::where('product_id', $detail->id)->get();
        $data['relates'] = $relate->get();
        $data['slug'] = $slug;
        return view('website.details', $data);
    }

    public function postComment(PostCommentRequest $request, $slug)
    {
        $detail = Product::where('slug', $slug)->first();
        $comment = new ProductReview();

        $user = Auth::guard('customer')->check()? Auth::guard('customer')->user() : '';
        if($user){
            $comment->product_id = $detail->id;
            $comment->customer_id = $user->id;
            $comment->customer_name = $user->name;
            $comment->customer_phone = $user->phone;
            $comment->customer_email =$user->email;
            $comment->comment = $request->comment;
            if($request->parent_id) {
                $comment->parent_id = $request->parent_id;
            }
            $comment->save();
            return back();

        } else {
            if($request->parent_id) {
                $comment->parent_id = $request->parent_id;
            }
            $comment->product_id = $detail->id;
            $comment->customer_name = $request->name;
            $comment->customer_phone = $request->phone;
            $comment->customer_email = $request->email;
            $comment->comment = $request->comment;
            $comment->save();
            if ($comment)
                return back();
        }
    }

    public function hidden($id)
    {
        $comment = ProductReview::findOrFail($id);
        if ($comment) {
            $comment->delete();
            return back();
        }
        else
            return redirect('/');
    }


    public function cart()
    {
        if (Request::isMethod('post')) {
            $product_id = Request::get('product_id');
            $product = Product::find($product_id);
            Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
        }
        if (Request::get('product_id') && (Request::get('increment')) == 1) {
            $rowId = Cart::search(array('id' => Request::get('product_id')));
            $item = Cart::get($rowId[0]);

            Cart::update($rowId[0], $item->qty + 1);
        }
        if (Request::get('product_id') && (Request::get('decrease')) == 1) {
            $rowId = Cart::search(array('id' => Request::get('product_id')));
            $item = Cart::get($rowId[0]);

            Cart::update($rowId[0], $item->qty - 1);
        }
        $cart = Cart::content();
        return view('website.cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }
}
