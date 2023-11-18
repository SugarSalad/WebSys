// Function to display a pop-up message
function showMessage(message, type) {
    if (type === 'success') {
        // Display a confirmation dialog
        var result = confirm('Success: ' + message + '\n\nClick OK to go to index.php');
        if (result) {
            // Redirect to index.php on successful account creation
            window.location.href = "index.php";
        }
    } else if (type === 'error') {
        // Display a confirmation dialog
        confirm('Error: ' + message);
    } else {
        // Display a confirmation dialog
        confirm('Message: ' + message);
    }
}
