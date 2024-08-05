<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();
$item = null;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $item = $blog->getItem($id);

    if ($item) {
        $item->incrementShowCount(); // Ensure this method is in BlogItem
        $blog->save(); // Save the updated show count to the file
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eintrag anzeigen</title>
</head>
<body>
    <h1>Eintrag anzeigen</h1>

    <?php if ($item) { ?>
        <h2><?= htmlspecialchars($item->getSubject()); ?></h2>
        <p><?= nl2br(htmlspecialchars($item->getBody())); ?></p>
        <p>Erstellt am: <?= htmlspecialchars($item->getCreateDate()); ?></p>
        <p>Show: <?= htmlspecialchars($item->getShow()); ?></p>
        <p>Aufrufe: <?= htmlspecialchars($item->getCountShowPage()); ?></p>
        <p>Bewertungen: <?= htmlspecialchars($item->getVoting()); ?> (<?= htmlspecialchars($item->getCountVoting()); ?> Bewertungen)</p>
    <?php } else { ?>
        <p>Eintrag nicht gefunden.</p>
    <?php } ?>

    <a href="blog.php">Zurück zur Startseite</a>
</body>
</html>
