<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $user = User::where('usertype', 'user')->count();
        $product = Product::count();
        $order = Order::count();
        $delivered = Order::where('status', 'მიტანილია!')->count();

        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    public function home()
    {
        $products = Product::all();
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.index', compact('products', 'count'));
    }

    public function login_home()
    {
        return $this->home();
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.product_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        $user = Auth::user();
        $userid = $user->id;

        $existing_cart_item = Cart::where('user_id', $userid)
                                  ->where('product_id', $id)
                                  ->first();

        if ($existing_cart_item) {
            return redirect()->back()->with('error', true);
        }

        Cart::create([
            'user_id' => $userid,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('success', true);
    }

    public function mycart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userid = Auth::id();
        $count = Cart::where('user_id', $userid)->count();
        $cart = Cart::where('user_id', $userid)->get();

        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart($id)
    {
        $data = Cart::findOrFail($id);
        $data->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('ნივთი წაიშალა!');

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {
            Order::create([
                'name' => $request->input('name'),
                'rec_address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'user_id' => $userid,
                'product_id' => $carts->product_id,
            ]);
        }

        Cart::where('user_id', $userid)->delete();

        return redirect()->back()->with('ordered', true);
    }

    public function all_products()
    {
        $products = Product::all();
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.all_products', compact('products', 'count'));
    }

    public function product_gallery(){

        $products = Product::where('category', 'ნახატი')->with('images')->get();
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.product_gallery', compact('count', 'products'));
    }

    public function contact()
    {
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.contact', compact( 'count'));
    }

}
