<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'] ?? '';
    $body = $_POST['body'] ?? '';
    $show = isset($_POST['show']);

    if ($blog->newItem($subject, $body, $show)) {
        $message = "Blog-Eintrag erfolgreich hinzugefügt.";
    } else {
        $message = "Fehler beim Hinzufügen des Blog-Eintrags. Betreff könnte zu lang sein.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuer Blog-Eintrag</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            height: 150px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
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
        .message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Neuer Blog-Eintrag</h1>
        <form action="neuerEintrag.php" method="post">
            <label for="subject">Betreff:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="body">Inhalt:</label>
            <textarea id="body" name="body" required></textarea>

            

            <button type="submit">Eintrag hinzufügen</button>
        </form>

        <?php if (isset($message)) { ?>
            <p class="message <?= isset($message) && strpos($message, 'erfolgreich') !== false ? 'success' : 'error'; ?>">
                <?= htmlspecialchars($message); ?>
            </p>
        <?php } ?>

        <a href="blog.php">Zurück zur Startseite</a>
    </div>
</body>
</html>
