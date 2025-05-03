<?php

Flight::group('/users', function() {

    Flight::route('GET /', function() {
        Flight::json(Flight::user_service()->getAllUsers());
    });

    Flight::route('GET /@id', function($id) {
        Flight::json(Flight::user_service()->getUserById($id));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::user_service()->addUser($data));
    });

    Flight::route('GET /email/@email', function($email) {
        Flight::json(Flight::user_service()->getByEmail($email));
    });

    Flight::route('GET /email-exists/@email', function($email) {
        Flight::json(['exists' => Flight::user_service()->emailExists($email)]);
    });
});
?>

//