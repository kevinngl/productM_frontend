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
                            <input type="text" class="edit-mode" value="{{ $product['product_name'] }}" style="display:none;">
                        </td>
                        <td>
                            <span class="view-mode">${{ $product['price'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['price'] }}" style="display:none;">
                        </td>
                        <td>
                            <span class="view-mode">{{ $product['category_id'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['category_id'] }}" style="display:none;">
                        </td>
                        <td>
                            <span class="view-mode">{{ $product['supplier_id'] }}</span>
                            <input type="text" class="edit-mode" value="{{ $product['supplier_id'] }}" style="display:none;">
                        </td>
                        <td>
                            <form method="post" action="{{ route('product.destroy', ['product_id' => $product['product_id']]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                            <button class="edit-button" data-product-id="{{ $product['product_id'] }}" onclick="toggleEditMode(this)">Edit</button>
                            <button class="save-button" data-product-id="{{ $product['product_id'] }}" style="display:none;" onclick="saveChanges(this)">Save</button>
                            <button class="cancel-button" data-product-id="{{ $product['product_id'] }}" style="display:none;" onclick="cancelChanges(this)">Cancel</button>
                            <button class="detail-button" data-product-id="{{ $product['product_id'] }}">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products available.</p>
    @endif
@endsection

<style>
    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .product-table th, .product-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .product-table th {
        background-color: #f2f2f2;
    }
</style>

<script>
    function toggleEditMode(button) {
        var rowId = button.getAttribute('data-product-id');
        var row = document.getElementById('row_' + rowId);

        // Turn off edit mode for all rows
        document.querySelectorAll('.edit-mode').forEach(function (element) {
            element.style.display = 'none';
        });

        // Turn on view mode for all rows
        document.querySelectorAll('.view-mode').forEach(function (element) {
            element.style.display = 'inline';
        });

        // Turn on edit mode for the selected row
        row.querySelectorAll('.edit-mode').forEach(function (element) {
            element.style.display = 'inline';
        });

        // Turn off view mode for the selected row
        row.querySelectorAll('.view-mode').forEach(function (element) {
            element.style.display = 'none';
        });

        // Toggle visibility of buttons
        row.querySelector('.edit-button').style.display = 'none';
        row.querySelector('.save-button').style.display = 'inline';
        row.querySelector('.cancel-button').style.display = 'inline';
        row.querySelector('.detail-button').style.display = 'none';
        row.querySelector('.delete-button').style.display = 'none';
    }

    function cancelChanges(button) {
        var rowId = button.getAttribute('data-product-id');
        var row = document.getElementById('row_' + rowId);

        // Turn off edit mode for the selected row
        row.querySelectorAll('.edit-mode').forEach(function (element) {
            element.style.display = 'none';
        });

        // Turn on view mode for the selected row
        row.querySelectorAll('.view-mode').forEach(function (element) {
            element.style.display = 'inline';
        });

        // Toggle visibility of buttons
        row.querySelector('.edit-button').style.display = 'inline';
        row.querySelector('.save-button').style.display = 'none';
        row.querySelector('.cancel-button').style.display = 'none';
        row.querySelector('.detail-button').style.display = 'inline';
        row.querySelector('.delete-button').style.display = 'inline';
    }

    function saveChanges(button) {
        var rowId = button.getAttribute('data-product-id');
        var row = document.getElementById('row_' + rowId);

        // You can add logic here to send data to the 'product.save' route
        // For simplicity, let's just log a message to the console
        console.log('Saving changes for row: ' + rowId);

        // Turn on view mode for the selected row
        row.querySelectorAll('.view-mode').forEach(function (element) {
            element.style.display = 'inline';
        });

        // Turn off edit mode for the selected row
        row.querySelectorAll('.edit-mode').forEach(function (element) {
            element.style.display = 'none';
        });

        // Toggle visibility of buttons
        row.querySelector('.edit-button').style.display = 'inline';
        row.querySelector('.save-button').style.display = 'none';
        row.querySelector('.cancel-button').style.display = 'none';
        row.querySelector('.detail-button').style.display = 'inline';
        row.querySelector('.delete-button').style.display = 'inline';
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listeners to all buttons with class 'edit-button'
        var editButtons = document.querySelectorAll('.edit-button');
        
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Retrieve the product ID from the data attribute
                var productId = this.getAttribute('data-product-id');
                
                // Call a function to enable edit mode for the corresponding row
                toggleEditMode(this);
            });
        });
    });
</script>
