<?php
session_start();
include 'header.php'; 

//code that tells error information if not working (REMOVE before finish project)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set variables using login.php form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

//link to file that connects to database
require 'dhb.Inc';

//search database for username and password variables
$squl = "SELECT username FROM AuthorizedUsers WHERE username ='$username' AND password = '$password'";
$result = mysqli_query($conn, $squl);

//error handling 
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}


$valid_login=false;

//checks if database has username and password matches
if (mysqli_num_rows($result) > 0) {
    $valid_login = true;
}

$_SESSION['logged_in'] = $valid_login;
$_SESSION['username'] = $username;

if ($valid_login) {
  setcookie('username', $username, time() + (86400 * 30), "/"); // Expires in 30 days

echo "Login successful! Welcome, " . htmlspecialchars($username) . "!";
   
//    $story_query = "SELECT * FROM stories"; 
//    $story_result = mysqli_query($conn, $story_query);
//
//    if (mysqli_num_rows($story_result) > 0) {
//      echo "<h2>Stories:</h2>";
//      while ($row = mysqli_fetch_assoc($story_result)) {
//        // Access story data and display them within HTML elements
//        $title = $row["title"];
//        $author = $row["author"];
//        $content = $row["content"];
//
//        echo "<div class='story'>";
//        echo "<h4>$title - <em>$author</em></h3>";
//        echo "<p>$content</p>";
//        echo "</div>";
//      }
//    } else {
//      echo "No stories found";
//    }

  echo "<br><a href='contentPage.php'>See Submitted Stories</a>";
} 
else {
  echo "Invalid username or password.";
}

include 'footer.php'; 
