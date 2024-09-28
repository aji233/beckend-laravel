<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $Product = Product::where('product_name', 'LIKE', "%{$search}%")
                        ->orWhere('category', 'LIKE', "%{$search}%")
                        ->orderBy('created_at', 'DESC')
                        ->get();
        } else {
            $Product = Product::orderBy('created_at', 'DESC')->get();
        }

        return response()->json([
            'success' => true,
            'data' => $Product
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:150|unique:products,product_name',
            'category' => 'required|string|max:100',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $Product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $Product,
        ], 201);
    }

    public function update(Request $request, product $product)
    {
        $id = $request->query('id');

        $validator = Validator::make($request->all(), [
            'product_name' => 'string|max:150',
            'category' => 'string|max:100',
            'price' => 'integer',
            'discount' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $Product = Product::find($id);

        if (!$Product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $Product->product_name = $request->input('product_name');
        $Product->category = $request->input('category');
        $Product->price = $request->input('price');
        $Product->discount = $request->input('discount');
        $Product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'Product' => $Product
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');

        $Product = Product::find($id);

        if (!$Product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $Product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
