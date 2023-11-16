        /* Function for Create Bill Button */
        $(document).ready(function() {
            // Load waterBillForm.php content on Create Bill button click
            $('#createBillButton').on('click', function() {
                $.get('./waterBillForm.php', function(data) {
                    var title = $(data).filter('title').text();

                // Update the page title
                document.title = title;
                    $('body').html(data);
                    history.pushState({}, null, 'waterBillForm.php'); // Change URL
                });
            });

            // To handle browser back/forward buttons
            window.onpopstate = function(event) {
                location.reload(); // Reload the page
            };
        });

        /* Function for View report Button */
        $(document).ready(function() {
            // Load Dashboard.php content on View Report button click
            $('.viewReport').on('click', function() {
                $.get('./Dashboard.php', function(data) {
                    var title = $(data).filter('title').text();

                // Update the page title
                document.title = title;
                    $('body').html(data);
                    history.pushState({}, null, 'Dashboard.php');
                });
            });

            // To keep Create Bill button functionality
            $('.createBill').on('click', function() {
                // Functionality for Create Bill button if needed
            });

            // Other buttons' functionalities can be similarly added here
        });



        /* Function for View update Button */
        $(document).ready(function() {
            // Show the update bill form as a pop-up when the page loads
            $('#overlay').fadeIn();
            $('#updateBillContainer').fadeIn();
        
            // Close the pop-up when clicking outside or on the form's close button
            $('#overlay').on('click', function(event) {
                if (event.target === this) {
                    $('#overlay, #updateBillContainer').fadeOut();
                }
            });
        });        