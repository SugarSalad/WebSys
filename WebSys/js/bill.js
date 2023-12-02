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

    $('.update-button').click(function () {
        console.log('Update button clicked');
        var billID = $(this).data('bill-id');
        console.log('BillID:', billID);
        console.log('Name:', $(this).closest('tr').data('name'));
        console.log('Date:', $(this).closest('tr').data('date'));
        console.log('Meter:', $(this).closest('tr').data('meter'));
        console.log('Amount:', $(this).closest('tr').data('amount'));
        console.log('Status:', $(this).closest('tr').data('status'));
    
        // Populate modal fields
        $('#billID').val(billID);
        $('#name').val($(this).closest('tr').data('name'));
        $('#date').val($(this).closest('tr').data('date'));
    
        // Remove commas and peso sign from Meter and Amount
        var meterValue = String($(this).closest('tr').data('meter')).replace(/,/g, '');
        var amountValue = String($(this).closest('tr').data('amount')).replace('₱', '').replace(/,/g, '');
    
        $('#currentReading').val(meterValue);
        $('#amount').val(amountValue);
    
        $('#status').val($(this).closest('tr').data('status'));
    
        // Show the modal
        $('#modalDialog').css('display', 'block');
    });
    
    $('#contactFrm').submit(function (event) {
        event.preventDefault();

        // Serialize the form data
        var formData = $(this).serialize();
        formData += '&billId=' + $('#billID').val();

        $.ajax({
            type: 'POST',
            url: './php/updateBill.php',
            data: formData,
            dataType: 'json',  // Specify that you expect JSON in the response
            success: function (response) {
                console.log('Ajax response:', response);

                // Handle the response from the server
                if (response.status === 'success') {
                    alert(response.message); // Display a success message
                    // Optionally, you can perform additional actions for success
                    location.reload();  // Reload the page after a successful update
                } else {
                    alert('Error: ' + response.message); // Display an error message
                }

                // Move this line inside the success callback if you want to log the BillID after a successful update
                console.log('BillID:', $('#billID').val());
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
});
