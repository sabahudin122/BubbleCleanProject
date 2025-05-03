<?php

Flight::group('/employees', function() {

    Flight::route('GET /email/@email', function($email) {
        Flight::json(Flight::employees_service()->getByEmail($email));
    });

    Flight::route('GET /', function() {
        Flight::json(Flight::employees_service()->getAll());
    });
});
?>