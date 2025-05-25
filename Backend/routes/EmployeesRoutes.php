<?php
Flight::group('/employees', function() {
    // Get all employees (Protected - Admin Role)
    Flight::route('GET /', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access
        Flight::json(Flight::employees_service()->getAll());
    });

    // Get employee by email (Protected - Admin Role)
    Flight::route('GET /email/@email', function($email) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access
        Flight::json(Flight::employees_service()->getByEmail($email));
    });
});