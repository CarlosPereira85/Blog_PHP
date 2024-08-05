<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();
$item = null;

if (!$blog->isLogin()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $item = $blog->getItem($id);

    if ($item) {
        if (!$blog->canEditOrDelete($id)) {
            echo "You do not have permission to edit this post.";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'] ?? '';
            $body = $_POST['body'] ?? '';
            $show = isset($_POST['show']);
            $creator = $_SESSION['username'] ?? ''; // Get the creator from session

            // Update the blog item
            $blogItems = $blog->getItems(); // Get the items array
            $blogItems[$id] = new BlogItem($subject, $body, $show, $creator);
            $blog->setItems($blogItems); // Update items in blog
            $blog->save();
            header('Location: blog.php');
            exit();
        }
    } else {
        echo "Eintrag nicht gefunden.";
        exit();
    }
} else {
    echo "ID nicht angegeben.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eintrag bearbeiten</title>
    <style>
        /* Basic reset and body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Container for content */
        .container {
            max-width: 800px;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
        }

        /* Heading styles */
        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #007BFF;
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

        /* Input field and textarea styling */
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 150px;
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

        /* Link styling */
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

        /* Checkbox styling */
        input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eintrag bearbeiten</h1>

        <?php if ($item) { ?>
            <form action="edit.php?id=<?= htmlspecialchars($_GET['id']); ?>" method="post">
                <label for="subject">Betreff:</label>
                <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($item->getSubject()); ?>" required>

                <label for="body">Inhalt:</label>
                <textarea id="body" name="body" required><?= htmlspecialchars($item->getBody()); ?></textarea>

                <label for="show">Show:</label>
                <input type="checkbox" id="show" name="show" <?= $item->getShow() ? 'checked' : ''; ?>>

                <button type="submit">Speichern</button>
            </form>
        <?php } ?>

        <a href="blog.php">Zurück zur Startseite</a>
    </div>
</body>
</html>
