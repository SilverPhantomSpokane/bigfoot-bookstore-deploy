<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Validators\ProductValidator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(): JsonResponse
{
    // 1) get list of products with pagination
    $products = Product::with(['department', 'user'])->paginate(10);

    // 2) return JSON response
    return response()->json(
        data: $products,
        status: Response::HTTP_OK
    );
}
    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request): JsonResponse
{
    // 1) Policy check
    $this->authorize('create', Product::class);

    try {
        // 2) Validate
        $validated = ProductValidator::validate($request->all());

        // 3) Add required fields
        $validated['user_id'] = $request->user()->id;

        // 4) Create product
        $product = Product::create($validated);

        // 5) Return response
        return response()->json(
            data: $product,
            status: Response::HTTP_CREATED
        );

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(
            data: ['errors' => $e->errors()],
            status: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
          // Policy check
    $this->authorize('view', $product);

    // Load relations and return JSON
    return response()->json(
        data: $product->load(['department', 'user']),
        status: Response::HTTP_OK
    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
         // 1) Policy check
    $this->authorize('update', $product);

    try {
        // 2) Validate incoming fields
        $validated = ProductValidator::validate($request->all());

        // 3) Update product
        $product->update($validated);

        // 4) Return updated product
        return response()->json(
            data: $product,
            status: Response::HTTP_OK
        );

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(
            data: ['errors' => $e->errors()],
            status: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
          // 1) Policy check 
    $this->authorize('delete', $product);

    // 2)delete product
    $product->delete();

    // 3) return response
    return response()->json(
        data: ['message' => 'Product deleted successfully.'],
        status: Response::HTTP_OK
    );
    }
}
