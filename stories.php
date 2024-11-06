<?php  
include "header.php"; ?>

<h1>Browse Stories:</h1>

<?php
//link to file that connects to database
require 'dhb.Inc';

    $story_query = "SELECT * FROM stories"; 
    $story_result = mysqli_query($conn, $story_query);

    if (mysqli_num_rows($story_result) > 0) {
        // for each row
      while ($row = mysqli_fetch_assoc($story_result)) {
        // Access story data and display them within HTML elements
        $title = $row["title"];
        $author = $row["author"];
        $content = $row["content"];
        $is_approved = $row["is_approved"];
        $show_email = $row["show_email"];
        $author_email = $row["author_email"];
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
        
        if ($is_approved){
            echo "<hr><p class='story'>";
            echo "<h4>$title</h4>";
            echo "<strong>Author: </strong>$author";
                if ($show_email)
                    echo " - <em>$author_email</em>";
            echo "<blockquote>$content</blockquote></p>";
            echo $topics_display;
            echo "</div>";
         } 
      
      }
    } else {
      echo "No stories found";
    }

    ?>

<button class="btn btn-primary"><a href="contentPage.php">View unapproved stories</a></button>

<?php include "footer.php"; ?>
