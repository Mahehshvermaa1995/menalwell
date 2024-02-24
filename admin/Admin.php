<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>

    <form id="login-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <div id="error-message" style="color: red; display: none;">Incorrect username or password.</div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login-form').submit(function(e){
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();

                // Check if username and password are correct
                if(username === 'admin' && password === '123456') {
                    // Redirect to dashboard.php
                    window.location.href = 'dashboard.php';
                } else {
                    // Show error message
                    $('#error-message').show();
                }
            });
        });
    </script>
</body>
</html>
