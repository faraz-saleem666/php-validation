<?php
// Define variables and set to empty values
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";
// Function to sanitize data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // Check password strength (minimum 8 characters, at least 1 number)
        if (strlen($password) < 8 || !preg_match("/[0-9]/", $password)) {
            $passwordErr = "Password must be at least 8 characters long and include at least one
   number";
        }
    }
    // If no errors, process the data (e.g., save to a database)
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        echo "Form submitted successfully!";
        // Here, you would typically insert the data into a database.
        // $file= 'saved_text.txt';
        // file_put_contents($file, $name, $email, $password);
    }
}
