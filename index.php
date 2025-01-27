<?php
// Include only the PHP logic, not the form
require_once("insert.php");

// Database connection to fetch the employee list
$conn = new mysqli("localhost", "root", "", "sampleDB");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employees from the database
$sql = "SELECT first_name, last_name, gender, address, email FROM employees";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Employee Registration</title>
      <link rel="stylesheet" type="text/css" href="styles.css">
   </head>
   <body>
      <h1>Employee Registration Form</h1>
      <!-- The Form -->
      <form action="index.php" method="post">
         <p>
            <label for="firstName">First Name:</label>
            <input type="text" name="first_name" id="firstName" required>
         </p>
         <p>
            <label for="lastName">Last Name:</label>
            <input type="text" name="last_name" id="lastName" required>
         </p>
         <p>
            <label for="Gender">Gender:</label>
            <input type="text" name="gender" id="Gender" required>
         </p>
         <p>
            <label for="Address">Address:</label>
            <input type="text" name="address" id="Address" required>
         </p>
         <p>
            <label for="emailAddress">Email Address:</label>
            <input type="email" name="email" id="emailAddress" required>
         </p>
         <input type="submit" value="Submit" name="submit_btn">
      </form>
      <?php 
         if (isset($success_msg)) {
             echo "<p style='color: green;'>$success_msg</p>";
         }
         if (isset($err_msg)) {
             echo "<p style='color: red;'>$err_msg</p>";
         }
      ?>
      <h2>List of Employees</h2>
      <!-- The Table -->
      <table>
         <thead>
            <tr>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Gender</th>
               <th>Address</th>
               <th>Email</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['email']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No employees found</td></tr>";
            }
            ?>
         </tbody>
      </table>
   </body>
</html>
