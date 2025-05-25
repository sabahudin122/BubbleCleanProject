<?php
Flight::group('/services', function() {
    // Get all services (Public)
    Flight::route('GET /', function() {
        Flight::json(Flight::services_service()->getAll());
    });

    // Add a new service (Protected - Admin Role)
    Flight::route('POST /', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can add services
        $data = Flight::request()->data->getData();
        Flight::json(Flight::services_service()->addService($data));
    });

    // Update a service (Protected - Admin Role)
    Flight::route('PUT /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can update services
        $data = Flight::request()->data->getData();
        Flight::json(Flight::services_service()->updateService($id, $data));
    });

    // Delete a service (Protected - Admin Role)
    Flight::route('DELETE /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can delete services
        Flight::json(Flight::services_service()->delete($id));
    });
});