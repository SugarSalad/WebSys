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
        });  



        var passwordField = document.getElementById("passwordField");
        var togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordField.type = "password";
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });

        function closeForm() {
            var form = document.getElementById("registrationForm");
            form.style.display = "none";
            window.location.href = "index.php"; // Redirects to index.php after form closure
            alert('Closing form...');
        }