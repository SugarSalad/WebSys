$(document).ready(function () {
    // Your form submission logic
    $('form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: './php/createbill.php',
            data: $('form').serialize(),
            success: function (response) {
                console.log('Ajax response:', response); // Log the entire response

                if (response.trim().toLowerCase() === 'success') {
                    console.log('Success: Bill created successfully.');
                    // showMessage('Success', 'Bill created successfully.', 'success');
                    $('form')[0].reset(); // Reset form inputs
                } else {
                    console.log('Error: Unexpected response.');
                    // showMessage('Error', 'Unexpected response from the server.', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.log('Ajax error:', xhr, status, error); // Log the error details
            }
        });
    });
});
