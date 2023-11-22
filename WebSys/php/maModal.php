<!-- Start The Modal or the PopUp-->
<div id="modalDialog" class="modal">
        <div class="modal-content animate-top">
            <div class="modal-header">
                <h5 class="modal-title">Update Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="./php/updateAccount.php" id="contactFrm">
            <div class="modal-body">
                <!-- Form submission status -->
                <div class="response"></div>

                 <!-- Hidden input for Bill ID -->
                 <input type="hidden" id="userID" name="userID" hidden required>
                
                <!-- Contact form -->
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>

                <div class="form-group">
                    <label for="houseNumber">House Number:</label>
                    <input type="text" id="houseNumber" name="houseNumber" required><br><br>
                </div>

                <div class="form-group">
                <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                    </select><br><br>
                </div>

                <div class="form-group">
                    <label for="emailAdd">Email Address:</label>
                    <input type="text" id="emailAdd" name="emailAdd" required><br><br>
                </div>

                <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" id="uname" name="uname" required><br><br>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" required><br><br>
                </div>

                <div class="form-group">
                <label for="lever">User-Level:</label>
                    <select id="level" name="level" required>
                              <option value="user">User</option>
                              <option value="admin">Admin</option>
                    </select><br><br>
                </div>

            </div>
            <div class="modal-footer">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

</script>
