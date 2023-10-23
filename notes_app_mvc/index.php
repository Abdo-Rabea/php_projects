<?php
include './includes/viewnotes.inc.php';
$updatemode = false;
$updatenote = ['id' => '', 'title' => '', 'description' => ''];
if (isset($_GET['id'])) {
    $updatemode = true;
    foreach ($notes as $note) {
        if ($note['id'] == $_GET['id']) {
            $updatenote = array_merge($updatenote, $note);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="./css/master.css">
</head>

<body>
    <div class="create-note">
        <div class="contianer">
            <form action="./includes/<?= $updatemode ? 'update' : 'newnote' ?>.inc.php" method="POST">
                <input type="hidden" name='id' value='<?= $updatenote['id'] ?>'>
                <input type="text" name="title" id="" placeholder="title" value="<?= $updatenote['title'] ?>">
                <textarea name="description" id="" rows="10" placeholder="description"><?= $updatenote['description'] ?></textarea>
                <?php if ($updatemode) : ?>
                    <button>update note</button>
                <?php else : ?>
                    <button>New note</button>
                <?php endif ?>
            </form>
        </div>
    </div>
    <div>
        <div class="contianer">
            <?php if (isset($notes)) : ?>
                <div class="notes">
                    <!-- print all notes -->
                    <?php foreach ($notes as $note) : ?>
                        <div class="note">
                            <a href="index.php?id=<?= $note['id'] ?>"><?= $note['title'] ?></a>
                            <p><?= $note['description'] ?></p>
                            <small> <?= $note['create_date'] ?></small>
                            <form action="./includes/delete.inc.php" method="POST">
                                <button>X</button>
                                <input type="hidden" name='id' value='<?= $note['id'] ?>'>
                            </form>

                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>