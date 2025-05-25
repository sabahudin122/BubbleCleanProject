<?php
Flight::group('/order-services', function() {
    // Get all order services by order ID (Protected - Admin and Manager Roles)
    Flight::route('GET /@orderId', function($orderId) {
        Flight::auth_middleware()->authorizeRoles(['admin', 'manager']); // Admins and managers can access
        Flight::json(Flight::order_services_service()->getAllOrderServices($orderId));
    });

    // Add a new order service (Protected - Admin Role)
    Flight::route('POST /', function() {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can add order services
        $data = Flight::request()->data->getData();
        Flight::json(Flight::order_services_service()->createOrderService($data));
    });

    // Update an order service (Protected - Admin Role)
    Flight::route('PUT /@id', function($id) {
        Flight::auth_middleware()->authorizeRole('admin'); // Only admins can update order services
        $data = Flight::request()->data->getData();
        Flight::json(Flight::order_services_service()->updateOrderService($id, $data));
    });
});
