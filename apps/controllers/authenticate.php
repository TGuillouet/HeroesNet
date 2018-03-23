<?php
// $input simulate a user
$input = new stdClass();
$input->username = 'test';
$input->password = 'test';

$user = $sqlQuery->auth($input->username);

//var_dump($user);

$output = new stdClass(); // New Empty object   

if ($user->size > 0)  { // If a user is found
    $password = $encrypt->decrypt($user->rows[0]->password, $user->rows[0]->salt, $user->rows[0]->iv); // Get the decrypted password
    if ($input->password == $password) {
        $output->is_logged = true;
        $output->username = $input->username;
        $output->full_name = ($user->rows[0]->full_name);
    } else {
        $output->is_logged = false;
        $output->error_msg = 'Invalid email adress or password !';
    }
} else {
    $output->is_logged = false;
    $output->error_msg = 'Invalid email adress or password !';
}

echo json_encode($output); // Display the result in a json encoded object