<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();
$item = null;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $item = $blog->getItem($id);

    if ($item) {
        $item->incrementShowCount(); // Increment the show count
        $blog->save(); // Save the updated show count to the file
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eintrag anzeigen</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { font-size: 24px; }
        .container { max-width: 800px; margin: auto; padding: 20px; background: #f4f4f4; border-radius: 8px; }
        .message { margin: 15px 0; padding: 10px; border-radius: 4px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        a { color: #007BFF; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eintrag anzeigen</h1>

        <?php if ($item) { ?>
            <h2><?= htmlspecialchars($item->getSubject()); ?></h2>
            <p><?= nl2br(htmlspecialchars($item->getBody())); ?></p>
            <p>Erstellt am: <?= htmlspecialchars($item->getCreateDate()); ?></p>
            
            <p>Aufrufe: <?= htmlspecialchars($item->getCountShowPage()); ?></p>
            <p>Bewertungen: <?= htmlspecialchars($item->getVoting()); ?> (<?= htmlspecialchars($item->getCountVoting()); ?> Bewertungen)</p>
        <?php } else { ?>
            <p>Eintrag nicht gefunden.</p>
        <?php } ?>

        <a href="blog.php">Zurück zur Startseite</a>
    </div>
</body>
</html>
