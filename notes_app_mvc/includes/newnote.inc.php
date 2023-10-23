<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    // send data to contr
    include '../classes/dbh.class.php';
    include '../classes/note.class.php';
    include '../classes/notecontr.class.php';
    $newnote = new NewNoteContr($title, $desc);
    $newnote->saveNote();
    // redirect into index page
    header('Location: ../index.php');
    exit;
}
