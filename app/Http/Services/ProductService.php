<?php

namespace App\Http\Services;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
public function purchaseProduct(User $user, int $productId): array
{
       
    {
        $userBalance = $user->balance;

        // Ищем продукт по ID
        $product = DB::table('products')->where('id', $productId)->first();

       
        if (!$product) {
            return ['error' => 'Product not found', 'status' => 404];
        }

       
        if ($userBalance < $product->price) {
            return ['message' => 'Not enough money', 'balance' => $user->balance, 'status' => 200];
        }

        
        DB::transaction(function () use ($user, $product) {
           
            $user->balance -= $product->price;
            $user->save();

            // Записываем покупку
            DB::table('purchases')->insert([
                'user_id' => $user->id,
                'email' => $user->email,
                'product_id' => $product->id,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

          
            DB::table('products')->where('id', $product->id)->increment('purchased');
        });

        // Возвращаем успешный результат
        return ['message' => 'Purchase successful', 'balance' => $user->balance, 'status' => 200];
    }
}
}