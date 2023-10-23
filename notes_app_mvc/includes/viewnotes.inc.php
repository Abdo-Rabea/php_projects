<?php
include __DIR__ . '/../classes/dbh.class.php';
include __DIR__ . '/../classes/note.class.php';
include __DIR__ . '/../classes/noteview.class.php';

$notesObj = new NoteView();
$notes = $notesObj->getAllNotes();
