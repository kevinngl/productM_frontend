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

        // Collect updated data from input fields
        var updatedData = {
            product_name: row.querySelector('.edit-mode[name="product_name"]').value,
            price: row.querySelector('.edit-mode[name="price"]').value,
            category_id: row.querySelector('.edit-mode[name="category_id"]').value,
            supplier_id: row.querySelector('.edit-mode[name="supplier_id"]').value,
        };

        // Send an AJAX request to update the product data
        var productId = rowId;
        var route = "{{ route('product.update', ['product_id' => ':product_id']) }}";
        route = route.replace(':product_id', productId);

        // Make sure to adjust the CSRF token and method as needed
        var csrfToken = "{{ csrf_token() }}";

        fetch(route, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(updatedData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Product updated:', data);
            
            // Reload the page after a successful update
            window.location.reload();
        })
        .catch(error => {
            console.error('Error updating product:', error);
        });

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

        // Add click event listener to all buttons with class 'save-button'
        var saveButtons = document.querySelectorAll('.save-button');

        saveButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Retrieve the product ID from the data attribute
                var productId = this.getAttribute('data-product-id');
                
                // Call a function to save changes for the corresponding row
                saveChanges(this);
            });
        });
    });

</script>