<!-- Start The Modal or the PopUp-->
<div id="modalDialog" class="modal">
        <div class="modal-content animate-top">
            <div class="modal-header">
                <h5 class="modal-title">Update Bill Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="contactFrm">
            <div class="modal-body">
                <!-- Form submission status -->
                <div class="response"></div>
                
                <!-- Contact form -->
                <div class="form-group">
                    <label for="name">Customer Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required><br><br>
                </div>

                <div class="form-group">
                    <label for="currentReading">Current Meter Reading:</label>
                    <input type="number" id="currentReading" name="currentReading" required><br><br>
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" required><br><br>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                    <option value="Paid">Paid</option>
                    <option value="Unpaid">Unpaid</option>
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