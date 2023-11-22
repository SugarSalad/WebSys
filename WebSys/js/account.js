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

    // Attach click event to update buttons
    $('.update-button, .aupdate-button').on('click', function () {
        // Extract data from the clicked row
        var userID = $(this).data('user-id');
        console.log('Update button clicked for UserID:', userID);
        var name = $(this).closest('tr').data('name');
        console.log('Name:', name);
        var houseNumber = $(this).closest('tr').data('house-number');
        console.log('HouseNumber:', houseNumber);
        var gender = $(this).closest('tr').data('gender');
        console.log('Gender:', gender);
        var email = $(this).closest('tr').data('email');
        console.log('Email:', email);
        var username = $(this).closest('tr').data('username');
        console.log('Username:', username);
        var password = $(this).closest('tr').data('password');
        console.log('Password:', password);
        var level = $(this).closest('tr').data('level');
        console.log('Level:', level);
    
        // Show the modal
        $('#modalDialog').css('display', 'block');
    
        // Populate modal fields
        $('#userID').val(userID);
        $('#name').val(name);
        $('#houseNumber').val(houseNumber);
        
        // Populate gender dropdown
        $('#gender option').each(function () {
            if ($(this).val() === gender) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        });
    
        $('#emailAdd').val(email);
        $('#uname').val(username);
        $('#password').val(password);
        
        // Populate level dropdown
        $('#level option').each(function () {
            if ($(this).val() === level) {
                $(this).prop('selected', true);
            } else {
                $(this).prop('selected', false);
            }
        });
    });

    $('#contactFrm').submit(function (event) {
        event.preventDefault();
    
        // Serialize the form data
        var formData = $(this).serialize();
        formData += '&userID=' + $('#userID').val(); // Change 'billID' to 'userID'
    
        $.ajax({
            type: 'POST',
            url: './php/updateAccount.php',
            data: formData,
            success: function (response) {
                console.log('Ajax response:', response);
    
                // Show a Bootstrap modal with the response message
                showModal(response);
    
                // Move this line outside if you want to log the UserID after a successful update
                // console.log('UserID:', $('#userID').val());
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
    
    // Function to show a Bootstrap modal with a message
    function showModal(message) {
        // Set the message in the modal body
        $('#modalDialog .modal-body .response').text(message);
    
        // Show the modal
        $('#modalDialog').modal('show');
    }
});
