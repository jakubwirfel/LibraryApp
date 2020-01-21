<?php
//session begin/resume
session_start();

//errors handler
$errors = [];

// DB access parameters
$db_access = [  'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'library' ];

//connect to DB
require('db.inc.php');

//add user class
require('../classes/user.class.php');

//make use of DB with user
$user = new User($database);