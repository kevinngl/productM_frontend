<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpringBootApiService
{
    protected $baseUrl;

    public function __construct($baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }
    public function getAllProducts()
    {
        $response = Http::get("{$this->baseUrl}/products/allProducts");

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }

    public function getAllCategories()
    {
        $response = Http::get("{$this->baseUrl}/categories/allCategories");

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }
    public function getAllSuppliers()
    {
        $response = Http::get("{$this->baseUrl}/suppliers/allSuppliers");

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }
    public function createProduct(array $data)
    {
        $response = Http::post("{$this->baseUrl}/products/addProducts", $data);

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }
    public function updateProduct($productId, array $data)
    {
        $response = Http::put("{$this->baseUrl}/products/updateProduct/{$productId}", $data);

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }

    public function deleteProduct($productId)
    {
        $response = Http::delete("{$this->baseUrl}/products/deleteProduct/{$productId}");

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json();
        }

        // Handle errors if needed
        return null;
    }

}
