<!-- Start The Modal or the PopUp -->
<div id="modalDialog" class="modal">
    <div class="modal-content animate-top">
        <div class="modal-header">
            <h5 class="modal-title">Update Account Information</h5>
            <!-- Close button -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <!-- Form submission -->
        <form method="post" action="./php/updateAccount.php" id="contactFrm">
            <div class="modal-body">
                <!-- Form submission status -->
                <div class="response"></div>

                <!-- Hidden input for User ID -->
                <input type="hidden" id="userID" name="userID" hidden required>

                <!-- Full Name input field -->
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>

                <!-- House Number input field -->
                <div class="form-group">
                    <label for="houseNumber">House Number:</label>
                    <input type="text" id="houseNumber" name="houseNumber" required><br><br>
                </div>

                <!-- Gender selection -->
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select><br><br>
                </div>

                <!-- Email Address input field -->
                <div class="form-group">
                    <label for="emailAdd">Email Address:</label>
                    <input type="text" id="emailAdd" name="emailAdd" required><br><br>
                </div>

                <!-- Username input field -->
                <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" id="uname" name="uname" required><br><br>
                </div>

                <!-- Password input field -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" required><br><br>
                </div>

                <!-- User-Level selection -->
                <div class="form-group">
                    <label for="level">User-Level:</label>
                    <select id="level" name="level" required>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select><br><br>
                </div>
            </div>
            <!-- Modal footer with Update button -->
            <div class="modal-footer">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<!-- End of Modal -->
