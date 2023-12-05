<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];

    // Save data to the database (Assuming you have a MySQL database)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contact";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert data into the table (replace 'your_table_name' with your actual table name)
    $sql = "INSERT INTO contact_submissions (name, mobile, email) VALUES ('$name', '$mobile', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved to the database successfully.";


       

        // Send email using mail function
        $to = "recipient_email@example.com"; // Replace with your actual recipient email
        $subject = "New Contact Form Submission";
        $query = $_POST['mas'];
        $message = "Hello,\n\nName: $name\nMobile: $mobile\nEmail: $email\nMessage: $query\n\nRegards,\n$name";
        $headers = "From: $name <$email>";

        if (mail($to, $subject, $message, $headers)) {
            // Email sent successfully, redirect to a thank you page or the same contact page
            header('location: contact.php');
            exit;
        } else {
            // Unable to send email, display an error message
            echo "Unable to send email. Please try again.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
