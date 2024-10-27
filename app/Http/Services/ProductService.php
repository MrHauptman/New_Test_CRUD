<?php

namespace App\Http\Services;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;



class ProductService {
    
public function createProduct(array $data, StoreProductRequest $request)
{
   
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/products', $filename);
        $data['image'] = $path;
    }
    return Product::create($data);
    
}

public function updateProduct(Product $product, array $data)
{
    return $product->update($data);
}

public function deleteProduct(Product $product)
{
    return $product->delete();
}

public function getProductById($id)
{
    return Product::findOrFail($id);
}

}