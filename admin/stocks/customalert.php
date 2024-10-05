<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Alert on Condition</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.alert {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    top: 200; /* Position at the top */
    left: 50%; /* Center the alert */
    transform: translateX(-50%); /* Offset to center */
    background-color: #f44336; /* Red background */
    color: white; /* White text */
    padding: 15px;
    width: 300px; /* Fixed width */
    text-align: center;
    z-index: 1000; /* Sit on top */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); /* Shadow effect */
}

    </style>
</head>
<body>
<div id="customAlert" class="alert">
        <p id="alertMessage">This is a custom alert message!</p>
        <button id="closeAlertButton">Close</button>
        <button id="purchaseButton">Go to Purchase</button> <!-- New Purchase Button -->
    </div>
    <script src="script.js"></script>
</body>
<script>
function showAlert(message) {
    const alertBox = document.getElementById('customAlert');
    alertBox.querySelector('p').innerText = message; // Set the alert message
    alertBox.style.display = 'block'; // Show the alert
}

document.getElementById('closeAlertButton').onclick = function() {
    document.getElementById('customAlert').style.display = 'none';
};

// Redirect to the purchase page when "Go to Purchase" button is clicked
document.getElementById('purchaseButton').onclick = function() {
    window.location.href = '<?php echo base_url ?>admin/?page=purchase_order'; // Replace with your purchase page URL
};
</script>
</html>
