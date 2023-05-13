$(document).ready(function() {
    // Handle "Delete Selected" button click
    $('#delete-selected-btn').click(function() {
        // Get all selected product IDs
        var selectedProductIds = $('input[name="product_id[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Send AJAX request to delete selected products
        $.ajax({
            url: 'delete_products.php',
            method: 'POST',
            data: {product_ids: selectedProductIds},
            success: function(response) {
                // Refresh page
                location.reload();
            },
            error: function() {
                alert('Error deleting products');
            }
        });
    });
});
