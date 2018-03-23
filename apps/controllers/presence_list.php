<?php
$users = $sqlQuery->getPresenceList();

echo json_encode($users);