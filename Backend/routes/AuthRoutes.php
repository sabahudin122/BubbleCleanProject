<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {

    // Route for user registration (Public)
    Flight::route('POST /register', function() {
        $data = Flight::request()->data->getData();

        $response = Flight::auth_service()->register($data);

        if ($response['success']) {
            Flight::json([
                'message' => 'User registered successfully',
                'data' => $response['data']
            ]);
        } else {
            Flight::halt(500, $response['error']);
        }
    });

    // Route for user login (Public)
    Flight::route('POST /login', function() {
        $data = Flight::request()->data->getData();

        $response = Flight::auth_service()->login($data);

        if ($response['success']) {
            Flight::json([
                'message' => 'User logged in successfully',
                'data' => $response['data']
            ]);
        } else {
            Flight::halt(500, $response['error']);
        }
    });

    // Route to verify JWT token (Protected - Admin Only)
    Flight::route('GET /verify', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access this route

        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            Flight::halt(401, 'Authorization header missing');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        try {
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::json(['success' => true, 'data' => $decoded]);
        } catch (Exception $e) {
            Flight::halt(401, 'Invalid or expired token');
        }
    });

    // Example: Route for fetching user profile (Protected - User Role)
    Flight::route('GET /profile', function() {
        Flight::auth_middleware()->authorizeRole('user'); // Only users can access their profile

        $user = Flight::get('user'); // Retrieve the authenticated user from the middleware
        Flight::json(['success' => true, 'data' => $user]);
    });

    // Example: Route for admin dashboard (Protected - Admin Role)
    Flight::route('GET /admin/dashboard', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access this route

        Flight::json(['message' => 'Welcome to the admin dashboard']);
    });

    // Example: Route for multi-role access (Admin and Manager)
    Flight::route('GET /reports', function() {
        Flight::auth_middleware()->authorizeRoles(['admin', 'manager']); // Admins and managers can access

        Flight::json(['message' => 'Access granted to reports']);
    });

});
?>
