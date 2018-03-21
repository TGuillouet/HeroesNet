<?php
// $input simulate a user
$input = new stdClass();
$input->username = 'test';
$input->password = 'test';
$input->first_name = 'test';
$input->last_name = 'test';

$existingUsers = $sqlQuery->userExist($input->username);

$output = new stdClass();

if ($existingUsers->size > 0) {
    $output->res = false;
    $output->error_msg = 'You can\'t use this username.';
} else {
    //if (preg_match('/^[a-zA-Z0-9._-+%]+$/', $input->password))
    $encrypted_password_array = $encrypt->encrypt($input->password);
    $sqlQuery->createUser($input, $encrypted_password_array);

    $output->res = true;
    $output->success_message = 'Your account has been created, please wait...';
    /*} else {
        $output->res = false;
        $output->error_msg = 'Your password is invalid, it must contains at least one capital letter, one number and one special char.'; 
    }*/
}

echo json_encode($output);