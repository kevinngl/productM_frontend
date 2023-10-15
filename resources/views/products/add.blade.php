 <!-- Simple form to add product data -->
 <h2>Add Product</h2>
    <form action="#" method="post">
        @csrf
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label for="category_id">Category:</label>
        <select name="category_id">
            <!-- Populate categories dynamically from your database -->
            @foreach($categories as $category)
                <option value="{{ $category['category_id'] }}">{{ $category['category_name'] }}</option>
            @endforeach
        </select>

        <label for="supplier_id">Supplier:</label>
        <select name="supplier_id">
            <!-- Populate suppliers dynamically from your database -->
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier['supplier_id'] }}">{{ $supplier['supplier_name'] }}</option>
            @endforeach
        </select>

        <button type="submit">Add Product</button>
    </form>