<!-- resources/views/products.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Product List</h1>

    @if (count($products) > 0)
        <table class="product-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($products as $product)
                    <tr id="row_{{ $product['product_id'] }}">
                        <td>{{ $i++ }}</td>
                        <td>
                            <span class="view-mode">{{ $product['product_name'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['product_name'] }}" style="display:none;" name="product_name">
                        </td>
                        <td>
                            <span class="view-mode">${{ $product['price'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['price'] }}" style="display:none;" name="price">
                        </td>
                        <td>
                            <span class="view-mode">{{ $product['category_id'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['category_id'] }}" style="display:none;" name="category_id">
                        </td>
                        <td>
                            <span class="view-mode">{{ $product['supplier_id'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['supplier_id'] }}" style="display:none;" name="supplier_id">
                        </td>
                        <td>
                        <button class="detail-button" data-product-id="{{ $product['product_id'] }}">Detail</button>

                            <button class="edit-button" data-product-id="{{ $product['product_id'] }}" onclick="toggleEditMode(this)">Edit</button>
                            <button class="save-button" data-product-id="{{ $product['product_id'] }}" style="display:none;" onclick="saveChanges(this)">Save</button>
                            <button class="cancel-button" data-product-id="{{ $product['product_id'] }}" style="display:none;" onclick="cancelChanges(this)">Cancel</button>
                            <form method="post" action="{{ route('product.destroy', ['product_id' => $product['product_id']]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products available.</p>
    @endif
@endsection
