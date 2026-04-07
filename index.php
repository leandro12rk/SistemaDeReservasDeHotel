<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the base path for includes
define('BASE_PATH', __DIR__ . '/');
define('BASE_PATH_ABSOLUTE', dirname(__DIR__, 2));
// Include the configuration file
require_once  'config.php';
//include "app/controller/user_controller.php";

// Include necessary files
require BASE_PATH. 'src/function.php';
require BASE_PATH. 'src/validaciones.php';
//include BASE_PATH. 'database/conection/Database.php';
require BASE_PATH. 'views/layout.php';

// Include the test file
//include_once 'test.php';
