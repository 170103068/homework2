<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['id']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else{
// Define $id and $password
$id = $_POST['id'];
$password = $_POST['password'];
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "company");
// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT id, password from login where id=? AND password=? LIMIT 1";
// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $id, $password);
$stmt->execute();
$stmt->bind_result($id, $password);
$stmt->store_result();
if($stmt->fetch()) //fetching the contents of the row {
$_SESSION['login_user'] = $id; // Initializing Session
header("location: profile.php"); // Redirecting To Profile Page
}
mysqli_close($conn); // Closing Connection
}
?>