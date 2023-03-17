<?php
    require_once '../models/Post.php';

    echo("init");


    if (!isset($GLOBALS['posts'])) {
    $GLOBALS['posts'] = "hello";
}
?>