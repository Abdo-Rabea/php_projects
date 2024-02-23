<?php
// execute on the loading of user.php page

$taskContr  = new TaskController();
$usertasks = $taskContr->getUserTasks($userid);
