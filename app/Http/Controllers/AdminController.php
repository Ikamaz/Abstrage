<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductImage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('კატეგორია დაემატა!');
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('კატეგორია წაიშალა!');

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
        $data->category_name = $request->category;
        $data->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('კატეგორია განახლდა!');
        return redirect('/view_category');

    }

    public function add_product()
    {
        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $data = new Product;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->code = $request->code;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $data->save();

        // Handling multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imagename);

                // Store each image in a separate model or table (e.g., ProductImage)
                $productImage = new ProductImage(); // Assuming you have a ProductImage model
                $productImage->product_id = $data->id; // Link the image to the product
                $productImage->image = $imagename;
                $productImage->save();
            }
        }

        toastr()->timeOut(5000)->closeButton()->addSuccess('პროდუქტი დაემატა!');

        return redirect()->back();
    }
    public function view_product()
    {
        // Fetch paginated products
        $products = Product::paginate(5);

        // Initialize an empty array to store images
        $productImages = [];

        // Loop through the paginated products and fetch images for each
        foreach ($products as $product) {
            $productImages[$product->id] = ProductImage::where('product_id', $product->id)->get();
        }

        // Pass both products and their images to the view
        return view('admin.view_product', compact('products', 'productImages'));
    }


    public function delete_product($id)
    {
        // Find the product by ID
        $data = Product::find($id);

        if ($data) {
            // Delete related orders for this product
            Order::where('product_id', $id)->delete();

            // Find all images related to this product in the ProductImage table
            $productImages = ProductImage::where('product_id', $id)->get();

            // Delete each product image file from the server
            foreach ($productImages as $image) {
                $image_path = public_path('products/' . $image->image);
                if (file_exists($image_path)) {
                    if (is_file($image_path)) {
                        unlink($image_path); // Delete the file
                    } else {
                        echo "Error: The path '$image_path' is not a file.";
                    }
                } else {
                    echo "Error: The file '$image_path' does not exist.";
                }
            }

            // Now delete the product images from the database
            ProductImage::where('product_id', $id)->delete();

            // Delete the product itself
            $data->delete();

            // Success message
            toastr()->timeOut(5000)->closeButton()->addSuccess('პროდუქტი და მისი სურათები წაიშალა!');
        } else {
            // Error message if product not found
            toastr()->timeOut(5000)->closeButton()->addError('პროდუქტი ვერ მოიძებნა!');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function remove_image($id)
    {
        $image = ProductImage::find($id);
        if ($image) {
            $filePath = public_path('products/' . $image->image);
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    $image->delete(); // Delete the image record from the database
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['success' => false, 'message' => 'File deletion failed']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'File does not exist']);
            }
        }
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

                // Save to the database
                $image = new ProductImage();
                $image->image = $filename;
                $image->product_id = $product->id; // Assuming you have a product_id field
                $image->save();
            }
        }

        $product->save();

        // return redirect()->back()->with('success', 'Product updated successfully!');
        return redirect('/view_product')->with('success', 'Product updated successfully!');
    }


    public function product_search(Request $request)
    {
        $search = $request->search;

        $products = Product::where(function ($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%')
                ->orWhere('category', 'LIKE', '%' . $search . '%')
                ->orWhere('price', 'LIKE', '%' . $search . '%');
        })
            ->paginate(5);

        return view('admin.view_product', compact('products'));
    }

    public function view_orders()
    {
        $data = Order::all();

        return view('admin.order', compact('data'));
    }

    public function on_the_way($id)
    {
        $data = Order::find($id);
        $data->status = 'გზაშია!';
        $data->save();
        return redirect('/view_orders');
    }

    public function delivered($id)
    {
        $data = Order::find($id);
        $data->status = 'მიტანილია!';
        $data->save();
        return redirect('/view_orders');
    }

    public function print_pdf($id)
    {
        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice', compact('data'));

        return $pdf->download('invoice.pdf');
    }

}
