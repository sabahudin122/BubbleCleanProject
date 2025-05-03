<?php
require 'vendor/autoload.php'; // Run autoloader

require_once __DIR__ . '/Backend/routes/UserRoutes.php';
require_once __DIR__ . '/Backend/routes/OrderRoutes.php';
require_once __DIR__ . '/Backend/routes/OrderServicesRoutes.php';
require_once __DIR__ . '/Backend/routes/ServiceRoutes.php';
require_once __DIR__ . '/Backend/routes/EmployeeRoutes.php';

Flight::start(); // Start FlightPHP
?>