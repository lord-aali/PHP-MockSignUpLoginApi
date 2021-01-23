<?php
function generateRandomString($users, $length = 32)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $randomString = $characters[rand(10, $charactersLength - 1)];
    for ($i = 0; $i < $length - 1; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if (!is_null($users)) {
        foreach ($users as $user) {
            if ($user["key"] == $randomString) {
                generateRandomString($users, $length);
            }
        }
    }
    return $randomString;
}