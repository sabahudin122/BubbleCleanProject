<?php
Flight::group('/users', function() {

    
    Flight::route('GET /', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access
        Flight::json(Flight::user_service()->getAllUsers());
    });

    // Get user by ID (Protected - Admin Role)
    Flight::route('GET /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can access
        Flight::json(Flight::user_service()->getUserById($id));
    });

    // Add a new user (Protected - Admin Role)
    Flight::route('POST /', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can add users
        $data = Flight::request()->data->getData();
        Flight::json(Flight::user_service()->addUser($data));
    });

    // Check if email exists (Public)
    Flight::route('GET /email-exists/@email', function($email) {
        Flight::json(['exists' => Flight::user_service()->emailExists($email)]);
    });
});