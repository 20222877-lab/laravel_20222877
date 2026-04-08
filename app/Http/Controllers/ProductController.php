<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // search
        if ($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // sort
        if ($request->sort == 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(5);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success','Thêm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success','Cập nhật thành công');
    }
    
    public function destroy($id)
    {
        Product::destroy($id);
        return back()->with('success','Xóa thành công');
    }

    public function dashboard()
    {
        return view('dashboard',[
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'latestProducts' => Product::latest()->take(5)->get()
        ]);
    }
}