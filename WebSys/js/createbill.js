$(document).ready(function () {
    function showMessage(title, message, type) {
        // Your message displaying logic here
        alert(`${title}: ${message}`);
    }

    $('form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: './php/createbill.php',
            data: $('form').serialize(),
            success: function (response) {
                console.log('Ajax response:', response);

                // Assume the server responds with JSON containing a 'status' field
                try {
                    const responseData = JSON.parse(response);
                    if (responseData.status === 'success') {
                        console.log('Success: Bill created successfully.');
                        showMessage('Success', 'Bill created successfully.', 'success');
                        $('form')[0].reset();
                    } else {
                        console.log('Error: Failed to create bill.');
                        showMessage('Error', 'Failed to create bill.', 'error');
                    }
                } catch (error) {
                    console.log('Error: Unexpected response format.');
                    showMessage('Error', 'Unexpected response format.', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.log('Ajax error:', xhr, status, error);
                showMessage('Error', 'An error occurred while processing your request.', 'error');
            }
        });
    });
});
