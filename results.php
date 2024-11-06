<?php
session_start();
include 'header.php'; 

//link to file that connects to database
require 'dhb.Inc';

//code that tells error information if not working (REMOVE before finish project)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set variables using story_submit form
//when applicable, variables are first trimmed before being assigned
//authorName is fName and lName put together
$authorName = (isset($_POST['first_name']) ? ucwords(trim($_POST['first_name'])) : '') . ' ' . (isset($_POST['last_name']) ? ucwords(trim($_POST['last_name'])) : '');
$email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : '';

//showemail is a variable that works like a boolean - if the user doesn't click on the checkbox to show it, it will be set to 0 ('false')
$showEmail = isset($_POST['show_email']) ? 1 : 0;

//the select values in the form are numbers that refer to the position_id in the positions table
$positionId = isset($_POST['position']) ? intval($_POST['position']) : 0;

// Sanitize and format the title
$title = isset($_POST['title']) ? mysqli_real_escape_string($conn, ucwords(trim($_POST['title']))) : '';

// Sanitize and format the story
$story = isset($_POST['story']) ? mysqli_real_escape_string($conn, ucfirst(trim($_POST['story']))) : '';


/*query to insert. 
 * NOTE WHAT IS NOT INSERTED:
 * story_id is automated, is_approved is defaulted to false/0 and has to changed by admins
 * date_posted is default to current time
 */
$selectedTopics = isset($_POST['topic']) ? $_POST['topic'] : [];

// This is an empty array to fill with the topic_ids as strings
$topicIdsArray = [];

// Foreach loop that fills the topic_ids array with the correct ids as strings
foreach ($selectedTopics as $topicId) {
    $topicId = strval($topicId); // Convert to string

    $topicIdsArray[] = $topicId; // Append topic ID (as a string) to the array
}

// Convert topic_ids array to JSON
$topicIdsJson = json_encode($topicIdsArray);

$query = "INSERT INTO stories(title, author, content,  author_email, show_email, topic_ids, position_id) "
        . "VALUES ('$title', '$authorName', '$story', '$email', '$showEmail', '$topicIdsJson', '$positionId')";

//if it works sends successful message
if(mysqli_query($conn, $query)){
    echo "<p>Thank you for submitting your story \"" . $title . "\".<br>";
    echo "We may be in touch with you regarding clarifications on the story.";
}

else {
    echo "Error: " . mysqli_error($conn);
}






include "footer.php";
