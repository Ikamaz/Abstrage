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
        $products = Product::where('is_ordered', false)
            ->orderBy('created_at', 'desc')
            ->limit(9)
            ->get();
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

    public function add_cart(Request $request, $id)
    {
        $user = Auth::user();
        $userid = $user->id;
        $quantity = $request->input('quantity', 1);

        $product = Product::find($id);

        $cartItem = Cart::where('user_id', $userid)->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->discount_price = $this->calculateDiscount($product->price, $cartItem->quantity);
            $cartItem->save();
            return redirect()->back()->with('success', 'პროდუქციის რაოდენობა განახლდა კალათაში.');
        } else {
            $finalPrice = $product->final_price;


            Cart::create([
                'user_id' => $userid,
                'product_id' => $id,
                'quantity' => $quantity,
                'discount_price' => $finalPrice * $quantity,
            ]);

            return redirect()->back()->with('success', 'პროდუქცია დამატებულია კალათაში.');
        }
    }

    private function calculateDiscount($price, $quantity)
    {
        $discountRate = 0.1;
        $totalPrice = $price * $quantity;
        return $totalPrice - ($totalPrice * $discountRate);
    }

    public function mycart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userid = Auth::id();
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            if ($product && $product->is_ordered) {
                $item->delete();
            }
        }
        $count = Cart::where('user_id', $userid)->count();
        $cart = Cart::where('user_id', $userid)->get();

        return view('home.mycart', compact('count', 'cart'));
    }

    public function updateCart(Request $request, $cartId)
    {
        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            if ($request->input('action') === 'increment') {
                $cartItem->quantity += 1;
            } elseif ($request->input('action') === 'decrement' && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }
            $cartItem->save();
        }

        return redirect()->back();
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
        $alreadyOrderedProducts = [];

        foreach ($cart as $carts) {
            $product = Product::find($carts->product_id);

            if ($product) {
                $finalPrice = $product->price;

                if ($product->discount_price) {
                    $finalPrice = $product->discount_price;
                } elseif ($product->discount_percentage) {
                    $finalPrice = $product->price - ($product->price * ($product->discount_percentage / 100));
                }

                $totalPrice = $finalPrice * $carts->quantity;

                if ($product->quantity >= $carts->quantity) {
                    $order = new Order;
                    $order->name = $name;
                    $order->rec_address = $address;
                    $order->phone = $phone;
                    $order->user_id = $userid;
                    $order->product_id = $carts->product_id;
                    $order->quantity = $carts->quantity;
                    $order->total_price = $totalPrice;  // Set total price
                    $order->save();

                    $product->quantity -= $carts->quantity;

                    if ($product->quantity == 0) {
                        $product->is_ordered = true;
                    }

                    $product->save();
                } else {
                    $alreadyOrderedProducts[] = $product->name;
                }
            }
        }

        Cart::where('user_id', $userid)->delete();

        return redirect()->back()->with('alreadyOrderedProducts', $alreadyOrderedProducts);
    }


    public function all_products(Request $request)
    {
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        $filters = $request->only(['category', 'min_price', 'max_price', 'sort']);
        foreach ($filters as $key => $value) {
            if (!$request->has($key) && session()->has($key)) {
                $filters[$key] = session()->get($key);
            }
            session()->put($key, $filters[$key]);
        }

        $query = Product::query();
        $cacheKey = 'products.' . md5($request->fullUrl());

        $products = Cache::remember($cacheKey, 60, function () use ($query, $filters) {
            if (!empty($filters['category']) && $filters['category'] !== 'all') {
                $query->where('category', $filters['category']);
            }

            if (!empty($filters['min_price'])) {
                $query->where('price', '>=', $filters['min_price']);
            }

            if (!empty($filters['max_price'])) {
                $query->where('price', '<=', $filters['max_price']);
            }

            if (!empty($filters['min_price']) && !empty($filters['max_price']) && $filters['min_price'] > $filters['max_price']) {
                return redirect()->back()->withErrors(['price' => 'Min price cannot be greater than Max price']);
            }

            if (!empty($filters['sort'])) {
                if ($filters['sort'] === 'price-asc') {
                    $query->orderBy('price', 'asc');
                } elseif ($filters['sort'] === 'price-desc') {
                    $query->orderBy('price', 'desc');
                }
            }

            $query->orderBy('is_ordered', 'asc');

            return $query->paginate(9);
        });

        $uniqueCategories = Product::distinct()->pluck('category');

        return view('home.all_products', compact('products', 'uniqueCategories', 'count'));
    }


    public function product_gallery()
    {
        $products = Product::where('category', 'ნახატი')
            ->where('is_ordered', false)
            ->with('images')
            ->paginate(10);

        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.product_gallery', compact('count', 'products'));
    }


    public function contact()
    {
        $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

        return view('home.contact', compact('count'));
    }

    public function myorders()
    {
        $user = Auth::id();
        $count = Auth::check() ? Cart::where('user_id', $user)->count() : 0;
        $order = Order::where('user_id', $user)
            ->with('product')
            ->get();

        return view('home.myorder', compact('count', 'order'));
    }

}
