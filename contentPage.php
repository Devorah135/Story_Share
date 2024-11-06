<?php
session_start();
include "header.php"; 

//link to file that connects to database
require 'dhb.Inc';

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  echo "Hello, " .  $username . "!";
} else {
  echo 'Error: You are not logged in';
  exit;
}


// Check if form is submitted to approve a story
if (isset($_POST['approve_story'])) {
  $storyId = intval($_POST['story_id']);
  $approveQuery = "UPDATE stories SET is_approved = 1 WHERE story_id = $storyId";
  if (mysqli_query($conn, $approveQuery)) {
    echo "<p class='success'>Story approved successfully!</p>";
  } else {
    echo "<p class='error'>Error approving story: " . mysqli_error($conn) . "</p>";
  }
}

    $story_query = "SELECT * FROM stories"; 
    $story_result = mysqli_query($conn, $story_query);

    if (mysqli_num_rows($story_result) > 0) {
      echo "<h2>Stories Waiting Approval:</h2>";
      while ($row = mysqli_fetch_assoc($story_result)) {
        // Access story data and display them within HTML elements
        $storyId = $row["story_id"];
        $title = $row["title"];
        $author = $row["author"];
        $content = $row["content"];
        $author_email = $row["author_email"];
        $show_email = $row["show_email"];
        $is_approved = $row["is_approved"];
        $topic_ids = json_decode($row["topic_ids"], true);
        
        //get an array of the topic NAMES if the array of IDs is not empty
        if (!empty($topic_ids)) {
            // impolde creates the array into a string seperated by commas so that the IN query works. intval makes it into integer values
            $topics_query = "SELECT topic_name FROM topics WHERE topic_id IN (" . implode(',', array_map('intval', $topic_ids)) . ")";
            $topics_result = mysqli_query($conn, $topics_query);

            $topic_names = [];

            while ($topic_row = mysqli_fetch_assoc($topics_result)) {
                $topic_names[] = $topic_row['topic_name']; // add topic name from current row to the array
            }
            $topics_display = "<small class='topics'>Topics: " . implode(', ', $topic_names) . "</small></p>";
        }
        else {
            $topics_display = "<small class ='topics'>No topics chosen.</small></p>";
        }

        if (!$is_approved){
            echo "<hr><p class='story'>";
            echo "<h4>$title</h4>";
            echo "<strong>Author: </strong>$author";
                if ($show_email)
                    echo " - <em>$author_email</em>";
            echo "<blockquote>$content</blockquote></p>";
            echo $topics_display;
            echo "<form method='post' style='display:inline;'>
                    <input type='hidden' name='story_id' value='$storyId'>
                    <button type='submit' name='approve_story' class='btn btn-primary'>Approve Story</button>
                  </form>";
            echo "</div>";
         } 
      
      }
    } else {
      echo "No unapproved stories found";
    }
    
    mysqli_close($conn);

    ?>
<!--<button class="btn btn-primary"><a href="index.php">Go to Home Page</a></button>-->

<?php include "footer.php"; ?>
