// Assuming you have included jQuery library
$(document).ready(function() {
    // Attach a click event handler to the delete buttons
    $('.delete-button').on('click', function() {
        // Get the BillID from the data-bill-id attribute
        var billId = $(this).data('bill-id');

        // Confirm before deletion
        if (confirm('Are you sure you want to delete this record?')) {
            // Make an AJAX request to deleteBill.php
            $.ajax({
                type: 'POST',
                url: './php/deleteBill.php', // Replace with the correct path
                data: { billId: billId },
                success: function(response) {
                    // Handle the response from the server
                    alert(response); // Display a message or update the UI as needed

                    // Reload the page after successful deletion
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ' + status + ', ' + error);
                }
            });

            // Move this line inside the success callback
            console.log('BillID:', billId);
        }
    });
});
