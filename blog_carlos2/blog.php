<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();
$items = $blog->getItems();
$title = $blog->getTitle();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title); ?></title>
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
            max-width: 900px;
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

        /* Navigation styling */
        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        ul li {
            display: inline;
            margin: 0 10px;
        }

        ul li a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        ul li a:hover {
            text-decoration: underline;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Action links styling */
        td a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        td a:hover {
            text-decoration: underline;
        }

        /* Additional styling for table cells with long content */
td.truncated {
    white-space: nowrap; /* Prevent text from wrapping to a new line */
    overflow: hidden;    /* Hide overflowed content */
    text-overflow: ellipsis; /* Add ellipsis (...) for overflowed content */
    max-width: 200px;    /* Adjust width as needed */
    display: block;      /* Ensures proper handling of overflow and ellipsis */
}

/* Ensure that long content is wrapped in a block element */
tr > td {
    max-width: 200px; /* Adjust the max-width as needed */
}

    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($title); ?></h1>

        <?php if ($blog->isLogin()) { ?>
            <ul>
                <li><a href="neuerEintrag.php">Neuen Eintrag erstellen</a></li>
                <li><a href="logout.php">Abmelden</a></li>
            </ul>
        <?php } else { ?>
            <ul>
                <li><a href="login.php">Anmelden</a></li>
            </ul>
        <?php } ?>

        <table>
            <tr>
                <th>Nummer</th>
                <th>Betreff</th>
                <th>Inhalt</th>
                <th>Erstellungsdatum</th>
                <th>Aktionen</th>
            </tr>

            <?php foreach ($items as $index => $item) { ?>
                <tr>
                    <td><?= $index + 1; ?></td> <!-- Displaying sequential number -->
                    <td><?= htmlspecialchars($item->getSubject()); ?></td>
                    <td class="truncated"><?= htmlspecialchars($item->getBody()); ?></td>
                    <td><?= htmlspecialchars($item->getCreateDate()); ?></td>
                    <td>
                        <a href="show.php?id=<?= $index; ?>">Show</a>
                        <?php if ($blog->canEditOrDelete($index)) { ?>
                            <a href="edit.php?id=<?= $index; ?>">Edit</a>
                            <a href="delete.php?id=<?= $index; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
