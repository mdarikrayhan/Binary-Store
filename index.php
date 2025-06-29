<?php
session_start();// for all the pages to use session variables
require 'config/database.php';
$config = require('config/config.php');
$db = new Database($config['database']);

define('ROOT_PATH', dirname(__FILE__) . '/'); // Define the base URL for the application

require 'app/models/user.model.php';
require 'app/models/category.model.php';
require 'app/models/product.model.php';
require 'app/models/order.model.php';

require 'functions.php';
require 'router.php';
