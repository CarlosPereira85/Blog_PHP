<?php
include 'includes/init.inc.php';

$blog = new Blog();


$blog->newItem('11111', '22222', '33333');



$items = $blog->getItems();
var_dump($items);

foreach ($items as $key => $item) {
    echo "$key -> {$item->getSubject()} -> {$item->getBody()} -> {$item->getCreateDate()}";
    echo "<br>Aufrufe: {$item->getCountShowPage()} <br>" . $item->getCountVoting() . '<hr>';
}
?>