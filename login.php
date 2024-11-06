<?php include __DIR__ . '/header.php'; ?>

<h1>Admin Login:</h1>

<form method="post" action="responsePage.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-input" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-input" required>
    </div>
    
    <button type="submit" value="login" class="btn btn-primary">Submit</button>
</form>

<?php include 'footer.php'; ?>
