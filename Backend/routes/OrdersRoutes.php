<?php

Flight::group('/orders', function() {

    Flight::route('GET /user/@customerId', function($customerId) {
        Flight::json(Flight::orders_service()->getByUserId($customerId));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::orders_service()->addOrder($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::orders_service()->updateOrder($id, $data));
    });
});
?>