
        // Get the error message from the URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        // Display a popup if there is an error
        if (error) {
            alert(error);
        }



        //for hiding password
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
