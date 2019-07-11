<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory;
use Cart;

class CartController extends Controller
{

	public function index()
	{
		$cart = Cart::content();
		return view('website.cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
	}
	
	public function addItem(Request $request)
	{
		$product = Product::find($request->id);
		if($product) {
			Cart::add(array('id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'weight'=>0));
		}
		$cart = Cart::content();
		return redirect ('/cart');
	}
	public function updateItem(Request $request)
	{
		$productId = $request->get('product_id');
		$qty = $request->get('qty');
		$rowId = $request->get('row_id');
		$data = [];

		if (Cart::update($rowId, $qty)) {
			$data['status'] = true;
			$data['total'] = Cart::total();
			return response()->json($data, 200);
		}

		return response()->json(['status' => false], 500);
	}
	public function deleteItem(Request $request)
	{
		if ($request->get('row_id')) {
			Cart::remove($request->get('row_id'));
			return response()->json(['status'=> true, 'total' =>Cart::total() ], 200);
		} else {
			return response()->json(['status' => false], 500);
		}
	}
	public function getJson(Request $request)
	{
		$data = [
			'kanh'=> [
				1=> 1009,
				2=> 9090,
				3=> 90,
				4=>989,
			],
			'sinhvien1' => [
				'ten' => 'Nguyen van a',
				'tuoi' => '18',
				'gioi tinh' => 'khon xac dinh',
			],
		];
		
		echo($this->getIp());
		// return response()->json($data);

	}
	public function getIp()
	{
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                	return $ip;
                }
            }
        }
    }
}

}
