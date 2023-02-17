<?php
include_once("classes/DB.php");
include_once("classes/user.php");
include_once("classes/comment.php");
include_once("classes/validator.php");

session_start();
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DBNAME", "guestbook");
define("CHARSET", "utf8");
define("SALT", "webDEVblog");
