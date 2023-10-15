<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Services\SpringBootApiService;

class ProductController extends Controller
{
    protected $springBootApiService;

    public function __construct(SpringBootApiService $springBootApiService)
    {
        $this->springBootApiService = $springBootApiService;
    }

    public function index()
    {
        // Example: Get all products from Spring Boot API
        $products = $this->springBootApiService->getAllProducts();
        $categories = $this->springBootApiService->getAllCategories();
        $suppliers = $this->springBootApiService->getAllSuppliers();

        // Process the data as needed

        return view('products.main', compact('products','categories','suppliers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
        ]);

        // Create a new product using the Spring Boot API service
        $newProduct = $this->springBootApiService->createProduct([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            // Add any other fields as needed
        ]);

        // You can handle the response from the API service as needed
        // For example, check if the product was created successfully

        // Redirect back to the product index page or wherever you want
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
    
    public function update(Request $request, $productId)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
        ]);
    
        // Update the product using the Spring Boot API service
        $updatedProduct = $this->springBootApiService->updateProduct($productId, [
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            // Add any other fields as needed
        ]);
    
        // You can handle the response from the API service as needed
        // For example, check if the product was updated successfully
    
        // Redirect back to the product index page or wherever you want
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }
    
    public function destroy($productId)
    {
        // Assuming you pass the product ID as a parameter

        // Use the Spring Boot API service to delete the product
        $result = $this->springBootApiService->deleteProduct($productId);

        // You can handle the response from the API service as needed
        // For example, check if the product was deleted successfully

        // Redirect back to the product index page or wherever you want
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
