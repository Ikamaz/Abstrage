<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductImage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();

        toastr()->success('კატეგორია დაემატა!');
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        if ($data) {
            $data->delete();
            toastr()->success('კატეგორია წაიშალა!');
        } else {
            toastr()->error('კატეგორია ვერ მოიძებნა!');
        }

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);

        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        if ($data) {
            $data->category_name = $request->category;
            $data->save();
            toastr()->success('კატეგორია განახლდა!');
        } else {
            toastr()->error('კატეგორია ვერ მოიძებნა!');
        }

        return redirect('/view_category');
    }

    public function add_product()
    {
        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $data = new Product();

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->code = $request->code;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $data->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imagename);

                $productImage = new ProductImage();
                $productImage->product_id = $data->id;
                $productImage->image = $imagename;
                $productImage->save();
            }
        }

        toastr()->success('პროდუქცია დაემატა!');
        return redirect()->back();
    }

    public function view_product()
    {
        $products = Product::paginate(5);
        $productImages = [];

        foreach ($products as $product) {
            $productImages[$product->id] = ProductImage::where('product_id', $product->id)->get();
        }
        return view('admin.view_product', compact('products', 'productImages'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);

        if ($data) {
            Order::where('product_id', $id)->delete();

            $productImages = ProductImage::where('product_id', $id)->get();
            foreach ($productImages as $image) {
                $image_path = public_path('products/' . $image->image);
                if (file_exists($image_path)) {
                    if (is_file($image_path)) {
                        unlink($image_path);
                    }
                }
            }

            ProductImage::where('product_id', $id)->delete();
            $data->delete();

            toastr()->success('პროდუქტი და მისი სურათები წაიშალა!');
        } else {
            toastr()->error('პროდუქტი ვერ მოიძებნა!');
        }

        return redirect()->back();
    }

    public function remove_image($id)
    {
        $image = ProductImage::find($id);
        if ($image) {
            $filePath = public_path('products/' . $image->image);
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    $image->delete();
                    toastr()->success('სურათი წარმატებით წაიშალა!');
                    return response()->json(['success' => true]);
                }
            }
            toastr()->error('ფაილის წაშლისას შეცდომა!');
            return response()->json(['success' => false, 'message' => 'File deletion failed']);
        }
        toastr()->error('სურათი ვერ მოიძებნა!');
        return response()->json(['success' => false, 'message' => 'Image not found']);
    }

    public function update_product($id)
    {
        $data = Product::find($id);
        $category = Category::all();

        return view('admin.update_page', compact('data', 'category'));
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->code = $request->code;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->qty;
            $product->category = $request->category;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('products'), $filename);
                    $image = new ProductImage();
                    $image->image = $filename;
                    $image->product_id = $product->id;
                    $image->save();
                }
            }

            $product->save();
            toastr()->success('პროდუქცია რედაქტირებულია!');
        } else {
            toastr()->error('პროდუქტი ვერ მოიძებნა!');
        }

        return redirect('/view_product');
    }

    public function product_search(Request $request)
    {
        $search = $request->search;

        $products = Product::where(function ($query) use ($search) {
            $query
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%')
                ->orWhere('category', 'LIKE', '%' . $search . '%')
                ->orWhere('price', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        toastr()->info('მოძებნილია პროდუქტები!');
        return view('admin.view_product', compact('products'));
    }

    public function view_orders()
    {
        $data = Order::paginate(5);
        return view('admin.order', compact('data'));
    }

    public function filter_orders(Request $request)
    {
        $query = Order::query();

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->input('name') . '%');
            });
        }

        if ($request->filled('product')) {
            $query->whereHas('products', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->input('product') . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $data = $query->paginate(10);
        toastr()->info('შეკვეთები ფილტრულია!');
        return view('admin.order', compact('data'));
    }

    public function view_users()
    {
        $users = User::where('usertype', 'user')->paginate(10);
        $admins = User::where('usertype', 'admin')->paginate(10);

        return view('admin.view_users', compact('users', 'admins'));
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = $request->usertype;
        $user->save();

        toastr()->success('მომხმარებელი განახლდა!');
        return redirect('/view_users');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toastr()->success('მომხმარებელი წაიშალა!');
        return redirect()->back();
    }
    public function markOnTheWay($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'on the way';
            $order->save();

            $product = Product::find($order->product_id);

            if ($product) {
                $product->is_ordered = true; // Mark product as ordered
                $product->save();
            }

            return redirect()->back()->with('success', 'შეკვეთა მონიშნულია როგორც გზაშია და პროდუქტი აღარ არის ხელმისაწვდომი.');
        }

        return redirect()->back()->with('error', 'შეკვეთა ვერ მოიძებნა.');
    }

    public function markSaved($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'saved';
            $order->save();

            $product = Product::find($order->product_id);

            if ($product) {
                $product->is_ordered = true; // Mark product as ordered
                $product->save();
            }

            return redirect()->back()->with('success', 'შეკვეთა მონიშნულია როგორც გადანახული და პროდუქტი აღარ არის ხელმისაწვდომი.');
        }

        return redirect()->back()->with('error', 'შეკვეთა ვერ მოიძებნა.');
    }

    public function markDelivered($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'delivered';
            $order->save();

            $product = Product::find($order->product_id);

            if ($product) {
                $product->is_ordered = true; // Mark product as ordered
                $product->save();
            }

            return redirect()->back()->with('success', 'შეკვეთა მონიშნულია როგორც მიტანილი და პროდუქტი აღარ არის ხელმისაწვდომი.');
        }

        return redirect()->back()->with('error', 'შეკვეთა ვერ მოიძებნა.');
    }

    public function export_orders()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function sendInvoice($id)
    {
        $order = Order::find($id);

        if (!$order) {
            toastr()->error('შეკვეთა ვერ მოიძებნა.');
            return redirect()->back();
        }

        if (!$order->user->email) {
            toastr()->error('ამ შეკვეთის ელფოსტა ვერ მოიძებნა.');
            return redirect()->back();
        }

        if ($order->product->images->isEmpty()) {
            toastr()->error('ფოტოსურათი ამ შეკვეთის ვერ მოიძებნა.');
            return redirect()->back();
        }

        try {
            Mail::to($order->user->email)->send(new InvoiceMail($order));
            toastr()->success('ინვოისი გაიგზავნა მომხარებლის ელფოსტა:' . $order->user->email, );
        } catch (\Exception $e) {
            \Log::error('Failed to send invoice: ' . $e->getMessage());
            toastr()->error('ვერ გაიგზავნა ინვოისი, თავიდან სცადეთ.');
        }

        return redirect()->back();
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);

        if ($order) {
            $product = Product::find($order->product_id);

            if ($product) {
                $product->is_ordered = false;
                $product->save();
            }

            $order->delete();

            return redirect()->back()->with('success', 'შეკვეთა გაუქმებულია.');
        }

        return redirect()->back()->with('error', 'შეკვეთა ვერ მოიძებნა.');
    }
}
