<?php
include 'includes/init.inc.php';

$user = 'carlos';
$pwd = '123';
$meldung = 'Benutzername und Passwort eingeben.';

session_start(); // Ensure session is started

$blog = new Blog();

if (isset($_POST['user']) && isset($_POST['pwd'])) {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    if ($blog->login($user, $pwd)) {
        header('Location: blog.php');
        die();
    } else {
        $meldung = '<span style="color: red">Benutzername und/oder Passwort sind falsch.</span>';
    }
}
?>
<style>
    /* Reset some default styles */
body, h1, p, form {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic styling for the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Styling for the login container */
.login-container {
    max-width: 400px;
    width: 100%;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
}

/* Heading style */
h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
}

/* Label styling */
label {
    font-weight: bold;
    margin-bottom: 5px;
    text-align: left;
}

/* Input field styling */
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

/* Button styling */
button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #007BFF;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Message styling */
p.message {
    margin: 15px 0;
    padding: 10px;
    border-radius: 4px;
    text-align: center;
}

p.message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

p.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Link styling */
a {
    display: block;
    margin-top: 15px;
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

</style>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="user">Benutzername:</label>
            <input type="text" id="user" name="user" required>
            <label for="pwd">Passwort:</label>
            <input type="password" id="pwd" name="pwd" required>
            <button type="submit">Login</button>
        </form>
        <p class="message <?= isset($meldung) && strpos($meldung, 'Falsch') !== false ? 'error' : 'success' ?>">
            <?= $meldung; ?>
        </p>
        <a href="blog.php">Zurück zur Startseite</a>
    </div>
</body>
</html>
