<?php

Flight::group('/orders', function() {

    // Get orders by user ID (Protected - User Role)
    Flight::route('GET /user/@customerId', function($customerId) {
        Flight::auth_middleware()->authorizeRole('user'); // Only users can access their orders
        Flight::json(Flight::orders_service()->getByUserId($customerId));
    });

    // Add a new order (Protected - User Role)
    Flight::route('POST /', function() {
        Flight::auth_middleware()->authorizeRole('user'); // Only users can create orders
        $data = Flight::request()->data->getData();
        Flight::json(Flight::orders_service()->addOrder($data));
    });

    // Update an order (Protected - Admin Role)
    Flight::route('PUT /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can update orders
        $data = Flight::request()->data->getData();
        Flight::json(Flight::orders_service()->updateOrder($id, $data));
    });

    // Delete an order (Protected - Admin Role)
    Flight::route('DELETE /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can delete orders
        Flight::json(Flight::orders_service()->deleteOrder($id));
    });

    // Get all orders (Protected - Admin and Manager Roles)
    Flight::route('GET /', function() {
        Flight::auth_middleware()->authorizeRoles(['admin', 'manager']); // Admins and managers can access
        Flight::json(Flight::orders_service()->getAllOrders());
    });

    // Get order details by ID (Protected - Admin and Manager Roles)
    Flight::route('GET /@id', function($id) {
        Flight::auth_middleware()->authorizeRoles(['admin', 'manager']); // Admins and managers can access
        Flight::json(Flight::orders_service()->getOrderById($id));
    });
});
?>