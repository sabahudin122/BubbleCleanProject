<?php
require 'vendor/autoload.php'; // Load Composer dependencies

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Register services
require_once __DIR__ . '/Backend/services/AuthService.php';
require_once __DIR__ . '/Backend/services/UserService.php';
require_once __DIR__ . '/Backend/services/ServicesService.php';
require_once __DIR__ . '/Backend/services/OrdersService.php';
require_once __DIR__ . '/Backend/services/OrderServicesService.php';
require_once __DIR__ . '/Backend/services/EmployeesService.php';

// Include AuthMiddleware
require_once __DIR__ . '/Backend/middleware/AuthMiddleware.php';

// Register services and middleware
Flight::register('auth_service', 'AuthService');
Flight::register('user_service', 'UserService');
Flight::register('services_service', 'ServicesService');
Flight::register('orders_service', 'OrdersService');
Flight::register('order_services_service', 'OrderServicesService');
Flight::register('employees_service', 'EmployeesService');
Flight::register('auth_middleware', 'AuthMiddleware');

// Middleware for global token verification
Flight::route('/*', function() {
    // Allow public access to login, register, and docs routes
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0 ||
        strpos(Flight::request()->url, '/docs') === 0
    ) {
        return true;
    }

    try {
        // Get the Authorization header
        $token = Flight::request()->getHeader("Authorization");
        if (!$token) {
            Flight::halt(401, "Missing authentication header");
        }

        // Remove "Bearer " prefix if present
        $token = str_replace('Bearer ', '', $token);

        // Use AuthMiddleware to verify the token
        if (Flight::auth_middleware()->verifyToken($token)) {
            return true;
        }
    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

// Include route files
require_once __DIR__ . '/Backend/routes/AuthRoutes.php';
require_once __DIR__ . '/Backend/routes/UserRoutes.php';
require_once __DIR__ . '/Backend/routes/ServicesRoutes.php';
require_once __DIR__ . '/Backend/routes/OrdersRoutes.php';
require_once __DIR__ . '/Backend/routes/OrderServicesRoutes.php';
require_once __DIR__ . '/Backend/routes/EmployeesRoutes.php';

// Start FlightPHP
Flight::start();
?>