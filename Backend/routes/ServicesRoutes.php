<?php

Flight::group('/services', function() {

    Flight::route('GET /', function() {
        Flight::json(Flight::services_service()->getAll());
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::services_service()->addService($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::services_service()->updateService($id, $data));
    });

    Flight::route('DELETE /@id', function($id) {
        Flight::json(Flight::services_service()->delete($id));
    });
});
?>

//