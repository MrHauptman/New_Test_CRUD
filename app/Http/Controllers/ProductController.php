<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

//use ProductService;



class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Create (POST)
    public function store(StoreProductRequest $request)
    {

        $data = $request->validated();
        $user = $request->user();
        $data['owner'] = $user->id;

        $product = $this->productService->createProduct($data, $request);
        return new ProductResource($product);
    }
    public function create()
    {
        return Inertia::render('Seller/CreateProductPage');
    }
    // Read (GET)
    // public function show($id)
    // {
    //     $product = $this->productService->getProductById($id);
    //     return new ProductResource($product); // Возвращаем ресурс
    // }

    
    public function update()
    {
        return Inertia::render("Seller/UpdateProductPage");
    }
    public function redact(UpdateProductRequest $request)
    {
        //dd($request->all()); //
        $productId = $request->input('id');
        $product = Product::findOrFail($productId);
        $data = $request->only(['name', 'price', 'description']);
        $updatedProduct = $this->productService->updateProduct($product, $data);
        return response()->json($updatedProduct);

    }

    // Delete (DELETE)
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return response()->json(null, 204);
    }
    public function index()
    {
    $products = Product::all();
    return ProductResource::collection($products);
    }

    public function myProducts(Request $request)
    {
        $userId = $request->user()->id;
        $products = DB::select('SELECT * FROM products WHERE owner = ?', [$userId]);

        // Adjust image path for each product using Storage::url()
        foreach ($products as $product) {
            $product->image = \Storage::url($product->image);
        }
    
        return response()->json($products);
    }
    public function purchase(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
       
        if (!$productId) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $result = $this->productService->purchaseProduct($user, $productId);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], $result['status']);
        }

        return response()->json([
            'message' => $result['message'],
            'balance' => $result['balance']
        ], $result['status']);

    }
    
}
