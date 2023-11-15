<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Bill Form</title>
    <link rel="stylesheet" href="../css/billForm.css">
</head>
<body>

<h2>Water Bill Form</h2>
<form method="post" action="process_form.php">
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br><br>

    <label for="currentReading">Current Meter Reading:</label>
    <input type="number" id="currentReading" name="currentReading" required><br><br>

    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required><br><br>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Paid">Paid</option>
        <option value="Unpaid">Unpaid</option>
    </select><br><br>

    <input type="submit" name="submit" value="Create Bill">
</form>

</body>
</html>
