<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    // send data to contr
    include '../classes/dbh.class.php';
    include '../classes/note.class.php';
    include '../classes/notecontr.class.php';
    $newnote = new NewNoteContr(1, 1);
    $newnote->deleteNoteWithId($id);

    // redirect into index page
    header('Location: ../index.php');
    exit;
}
