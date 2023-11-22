$(document).ready(function () {
    // Attach click event to delete buttons
    $('.delete-button').on('click', function () {
        // Get the user ID from the data attribute
        var userId = $(this).data('user-id');

        // Confirm deletion
        if (confirm('Are you sure you want to delete this user?')) {
            // Make an AJAX request to deleteAcc.php
            $.ajax({
                type: 'POST',
                url: './php/deleteAcc.php',
                data: { userId: userId },
                success: function (response) {
                    // Handle the response (e.g., show a message)
                    alert(response);
                    // Optionally, you can reload the page or update the table
                    location.reload();
                },
                error: function (error) {
                    // Handle errors
                    console.log('Error:', error);
                }
            });
        }
    });
});
