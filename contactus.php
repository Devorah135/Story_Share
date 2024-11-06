<?php include "header.php"; ?>

<h1>Contact Us</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="form-group">
    <label for="name">Name (Optional):</label>
    <input type="text" name="name" id="name" class="form-input">
  </div>
  
  <div class="form-group">
    <label for="email">Email Address (Required):</label>
    <input type="email" name="email" id="email" class="form-input" required>
  </div>
  
  <div class="form-group">
    <label for="message">Message:</label>
    <textarea name="message" id="message" rows="5" class="form-input" required></textarea>
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
</form>

<?php
// Check if form is submitted
if (isset($_POST['submit'])) {

  // Get form data
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $message = isset($_POST['message']) ? $_POST['message'] : '';

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } else {
    $subject = "StoryShare Contact Us - " . $name . " (" . $email . ")";

    // Prepare email body
    $body = "Name: " . $name . "\n";
    $body .= "Email: " . $email . "\n\n";
    $body .= "Message: \n" . $message;
    
    require 'PHPMailer-master/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0; // Disable debugging
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'storyshare358@gmail.com';
    $mail->Password = 'wxnbfcpwbyguoznw';
    $mail->setFrom('storyshare358@gmail.com', 'StoryShare');
    $mail->addAddress('storyshare358@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $body;
    
    // Send the message, check for errors
    if (!$mail->send()) {
      $error = "ERROR: " . $mail->ErrorInfo . "There was an error sending your message. Please try again later.";
    } else {
      $success = "Thank you for contacting StoryShare! We will respond to your message within 24 hours (business days).";
    }
  }
}
?>

<?php 
if (isset($success)): 
  echo '<p class="success">' . $success . '</p>';
elseif (isset($error)): 
  echo '<p class="error">' . $error . '</p>';
endif; 
?>


<h2>Contact Information:</h2>

<div class="contact-info">
  <p>
    <strong>Email:</strong>
    <a href="mailto:storyshare358@gmail.com">storyshare358@gmail.com</a>
  </p>
  
  <p>
    <strong>Phone:</strong>
    <a href="tel:1234567890">(123) 456-7890</a>
  </p>
</div>

<?php include "footer.php"; ?>
