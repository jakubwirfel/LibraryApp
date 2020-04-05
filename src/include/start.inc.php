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

//add classes
require('./src/classes/user.class.php');
require('./src/classes/change_password.class.php');
require('./src/classes/user_services.class.php');
require('./src/classes/post_services.class.php');
require('./src/classes/notification_services.class.php');
require('./src/classes/contact_services.class.php');
require('./src/classes/help_article_services.class.php');
require('./src/classes/book_services.class.php');
//make use of DB with user
$user = new User($database);