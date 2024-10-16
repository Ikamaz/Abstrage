<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function index()
    {
        $user = User::where('usertype', 'user')->count();
        $product = Product::count();
        $order = Order::count();
        $delivered = Order::where('status', 'saved')->count();

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
        $data = Product::findOrFail($id);

        $relatedProducts = Product::where('category', $data->category)
            ->where('id', '!=', $id)
            ->where('is_ordered', false)
            ->inRandomOrder()
            ->limit(9)
            ->get();

        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.product_details', compact('data', 'relatedProducts', 'count'));
    }

    public function add_cart($id)
    {
        $user = Auth::user();
        $userid = $user->id;

        $existing_cart_item = Cart::where('user_id', $userid)
            ->where('product_id', $id)
            ->first();

        if ($existing_cart_item) {
            return redirect()->back()->with('error', 'პროდუქტი უკვე კალათშია!');
        }

        Cart::create([
            'user_id' => $userid,
            'product_id' => $id,
        ]);

        flash()->success('წარმატებით დაემატა კალათაში');

        return redirect()->back();
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

        flash()->Success('ნივთი წაიშალა!');

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();
            $product = Product::find($carts->product_id);
            if ($product) {
                $product->is_ordered = true;
                $product->save();
            }
        }
        Cart::where('user_id', $userid)->delete();

        flash()->success('თქვენი პროდუქცია გადანახულია');

        return redirect()->back();
    }
    public function all_products(Request $request)
    {
        $query = Product::query();

        // Build cache key based on request parameters
        $cacheKey = 'products.' . md5($request->fullUrl());

        // Attempt to get cached products
        $products = Cache::remember($cacheKey, 60, function () use ($query, $request) {
            // Filtering by category
            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category', $request->category);
            }

            // Filtering by price range
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Ensure min_price is less than max_price
            if ($request->filled('min_price') && $request->filled('max_price') && $request->min_price > $request->max_price) {
                return redirect()->back()->withErrors(['price' => 'Min price cannot be greater than Max price']);
            }

            // Sorting
            if ($request->filled('sort')) {
                if ($request->sort === 'price-asc') {
                    $query->orderBy('price', 'asc');
                } elseif ($request->sort === 'price-desc') {
                    $query->orderBy('price', 'desc');
                }
            }

            // Fetch products with pagination
            return $query->paginate(9);
        });

        // Fetch unique categories for the filter
        $uniqueCategories = Product::distinct()->pluck('category');

        return view('home.all_products', compact('products', 'uniqueCategories'));
    }



    public function product_gallery()
    {
        $products = Product::where('category', 'ნახატი')->with('images')->get();
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.product_gallery', compact('count', 'products', ));
    }

    public function contact()
    {
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.contact', compact('count'));
    }

    public function myorders()
    {

        $user = Auth::user()->id;

        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        $order = Order::where('user_id', $user)->get();


        return view('home.myorder', compact('count', 'order'));
    }
}
