<?php

Flight::group('/order-services', function() {

    Flight::route('GET /@orderId', function($orderId) {
        Flight::json(Flight::order_services_service()->getAllOrderServices($orderId));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::order_services_service()->createOrderService($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::order_services_service()->updateOrderService($id, $data));
    });
});
?>

//