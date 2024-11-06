<?php include "header.php";
require 'dhb.inc';

// Fetch topics from the database
$sql_topics = "SELECT * FROM topics";
$result_topics = $conn->query($sql_topics);

// Fetch positions from the database
$sql_positions = "SELECT * FROM positions";
$result_positions = $conn->query($sql_positions);
?>
   <form name="StorySubmission" method="post" action="results.php">
   <div id="submission-fields">
    <!-- User information -->
    <fieldset id="user_info">
        <legend>User Information</legend>
        <div class="form-group">
            <label for="fname">First Name:*</label>
            <input type="text" id="fname" class="form-input" name="first_name" placeholder="First" size="8" required/>
        </div>
        
        <div class="form-group">
            <label for="lname">Last Name:*</label>
            <input type="text" id="lname" class="form-input" name="last_name" placeholder="Last" size="8" required />
        </div>
        
        <div class="form-group">
            <label for="email">Email:*</label>
            <input type="email" id="email" class="form-input" name="email" placeholder="story@example.com" required /><br>
        </div>
        
        <input type="checkbox" id="show_email" name="show_email" value="show_email"/>
        <label for="show_email">Share Email with Users?</label><br> <br>
        
        <div class="form-group">
            <label for="position">Position*</label><br>
            <select name="position" id="position" class="form-input" required>
                <?php
                if ($result_positions->num_rows > 0) {
                    // Output data of each row
                    while($row = $result_positions->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row["position_id"]) . '">' . htmlspecialchars($row["position_name"]) . '</option>';
                    }
                } else {
                    echo '<option value="">No positions available</option>';
                }
                ?>
            </select>
        </div>
    </fieldset>
    
    <!-- Story information -->
    <fieldset id="story_info"> 
        <legend>Story Information</legend>
        <div id="title-and-story">
            <div class="form-group">
                <label for="title">Story Title:</label>
                <input type="text" class="form-input" name="title" id="title" value="" required/>
            </div>
            
            <div class="form-group">
                <label for="story">Enter the story:</label><br>
                <textarea id="story" class="form-input" name="story" rows="5" cols="40" placeholder="Your story here:" required></textarea>
            </div>
        </div>
        
        <!-- Topics -->
        <div id="topics">
            <span>Choose which topics your story belongs to:</span><br>
            <?php
            if ($result_topics->num_rows > 0) {
                // Output data of each row
                while($row = $result_topics->fetch_assoc()) {
                     $topicId = htmlspecialchars($row["topic_id"]);
                     $topicName = htmlspecialchars($row["topic_name"]);
                     
                    echo '<input type="checkbox"' . 'id="' . $topicName . '" name="topic[]" value="' . $topicId . '" />';
                    echo '<label for="' . $topicName . '">' . $topicName . '</label><br>';
                }
            } else {
                echo "No topics available.";
            }
            $conn->close();
            ?>
        </div>
    </fieldset>
   </div>
    <button type="submit" value="submit" class="btn btn-primary">Submit Story</button>
</form>

<?php include "footer.php"; ?>
