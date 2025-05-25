<?php

use PHPUnit\Framework\TestCase;

class RoutesTest extends TestCase {
    public function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../index.php';
        Flight::halt(false);  // Prevent auto-exit during tests
        Flight::start();      // Start the FlightPHP app
    }

    // Test GET /users (Admin Role)
    public function testGetAllUsers()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/users';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer <admin_token>'; // Replace with a valid admin token

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    // Test GET /users/@id (Admin Role)
    public function testGetUserById()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/users/1';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer <admin_token>'; // Replace with a valid admin token

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id":1', $output);
    }

    // Test POST /users (Admin Role)
    public function testAddUser()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/users';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer <admin_token>'; // Replace with a valid admin token
        $_POST = [
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'role' => 'user'
        ];

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"email":"testuser@example.com"', $output);
    }

    // Test GET /services (Public)
    public function testGetAllServices()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/services';

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    // Test POST /services (Admin Role)
    public function testAddService()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/services';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer <admin_token>'; // Replace with a valid admin token
        $_POST = [
            'name' => 'Test Service',
            'price' => 100
        ];

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"name":"Test Service"', $output);
    }

    // Test DELETE /services/@id (Admin Role)
    public function testDeleteService()
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/services/1';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer <admin_token>'; // Replace with a valid admin token

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }
}