<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link href="login.css" rel="stylesheet">
</head>
<body>
    <form action="login_check.php" method="post">
        <div class="username">
            <img src="donut.png" height="40px">
            <h1>The Donut Whole</h1>

            <div class="name">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="email@mail.com" required>
            </div>
            <br>

            <div class="password">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="your password" required>
            </div>
            <br>

            <a href="#">Forgot password?</a>
            <br><br>

            <div class="button">
                <input type="submit" value="Login">
            </div>

            <br>
            <a href="new5.html">Create a new account</a>
        </div>
    </form>
</body>
</html>
