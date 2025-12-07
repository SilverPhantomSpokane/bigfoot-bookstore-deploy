<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List of products by department
    public function index(Department $department)
    {
        $products = $department->products()->paginate(10);
        return view('products.index', compact('department', 'products'));
    }

    // Show create form for a product in a specific department
    public function create(Department $department)
    {
        $this->authorize('create', Product::class);

        return view('products.create', compact('department'));
    }

    // Save new product
    public function store(ProductRequest $request, Department $department)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validated();
        $validated['department_id'] = $department->id; 
        $validated['user_id'] = $request->user()->id; // assign owner

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        Product::create($validated);

        return redirect()
            ->route('departments.show', $department)
            ->with('success', 'Product created successfully.');
    }

    // View single product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Edit product
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $product->update($validated);

        return redirect()
            ->route('departments.show', $product->department)
            ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $department = $product->department;
        $product->delete();

        return redirect()
            ->route('departments.show', $department)
            ->with('success', 'Product deleted successfully.');
    }
}
