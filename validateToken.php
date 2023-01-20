<?php

//imports
require 'config/database/dbConnection.php';
require 'auth/retrieveLastToken.php';
require 'auth/isTokenValid.php';
require 'auth/generateNewToken.php';




$token = retrieveLastToken($db);

if (isTokenValid($token) == false) {
    generateNewToken($db);
    $token = retrieveLastToken($db);
}

