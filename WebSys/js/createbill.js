$(document).ready(function () {

    function getCurrentDate() {
        const now = new Date();
        const formattedDate = now.toISOString().split('T')[0];
        return formattedDate;
    }

    // Set the current date to the date input field
    $('#date').val(getCurrentDate());

    // Your form submission logic
    $('form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: './php/createbill.php',
            data: $('form').serialize(),
            dataType: 'json', // Ensure the expected data type is JSON
            success: function (response) {
                console.log('Ajax response:', response); // Log the entire response

                if (response.status === 'success') {
                    console.log('Success: Bill created successfully.');
                    showMessage('Bill created successfully.', 'success');
                    $('form')[0].reset(); // Reset form inputs
                } else if (response.status === 'error' && response.message.includes('User not found')) {
                    console.log('Error: User not found.');
                    showMessage('CUSTOMER NAME not found. Please check the provided name.', 'error');
                } else {
                    console.log('Error: Unexpected response.');
                    showMessage('Failed to create bill. Please try again.', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.log('Ajax error:', xhr, status, error); // Log the error details
                showMessage('An error occurred while processing your request.', 'error');
            }
        });
    });

    // Function to display popup message
    function showMessage(message, type) {
        if (type === 'success') {
            alert(message); // Show a simple alert for success
        } else {
            alert('Error: ' + message); // Show a simple alert for error
        }
    }
});
