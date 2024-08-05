<?php

function meinAutoloader($klasse) {
    # Uncomment the next line if you want to debug which classes are being loaded.
    # echo 'Die Klasse "' . $klasse . '" gibt es nicht.<hr>';

    $file = 'classes/' . $klasse . '.class.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo '<p style="color: red">Konnte Klasse "' . $klasse . '" nicht laden.<hr></p>';
        die();
    }
}

spl_autoload_register('meinAutoloader');
