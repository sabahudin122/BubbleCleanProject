<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Backend/services/UserService.php';
require_once __DIR__ . '/../Backend/services/OrdersService.php';
require_once __DIR__ . '/../Backend/services/OrderServicesService.php';
require_once __DIR__ . '/../Backend/services/ServicesService.php';
require_once __DIR__ . '/../Backend/services/EmployeesService.php';

class ServiceTest extends TestCase {
    private $userService;
    private $ordersService;
    private $orderServicesService;
    private $servicesService;
    private $employeesService;

    protected function setUp(): void {
        $this->userService = new UserService();
        $this->ordersService = new OrdersService();
        $this->orderServicesService = new OrderServicesService();
        $this->servicesService = new ServicesService();
        $this->employeesService = new EmployeesService();
    }

    // UserService Tests
    public function testGetByEmail() {
        $email = "test@example.com";
        $result = $this->userService->getByEmail($email);
        $this->assertIsArray($result);
    }

    public function testEmailExists() {
        $email = "test@example.com";
        $result = $this->userService->emailExists($email);
        $this->assertIsBool($result);
    }

    public function testAddUser() {
        $user = ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'password' => 'securepassword'];
        $result = $this->userService->addUser($user);
        $this->assertIsArray($result);
    }

public function testAddOrder() {
    $order = ['customer_id' => 1, 'total_price' => 100.50];
    $result = $this->ordersService->addOrder($order);
    $this->assertIsNumeric($result);
}

    public function testGetByUserId() {
        $customerId = 1;
        $result = $this->ordersService->getByUserId($customerId);
        $this->assertIsArray($result);
    }

    // OrderServicesService Tests
    public function testCreateOrderService() {
        $data = ['order_id' => 1, 'service_id' => 2];
        $result = $this->orderServicesService->createOrderService($data);
        $this->assertTrue($result);
    }

    public function testGetAllOrderServices() {
        $id = 1;
        $result = $this->orderServicesService->getAllOrderServices($id);
        $this->assertIsArray($result);
    }

    // ServicesService Tests
    public function testAddService() {
        $service = ['service_name' => 'Cleaning', 'price' => 50.00];
        $result = $this->servicesService->addService($service);
        $this->assertTrue($result);
    }

    public function testUpdateService() {
        $id = 1;
        $data = ['service_name' => 'Updated Cleaning', 'price' => 60.00];
        $result = $this->servicesService->updateService($id, $data);
        $this->assertTrue($result);
    }

    // EmployeesService Tests
    public function testGetByEmailEmployee() {
        $email = "employee@example.com";
        $result = $this->employeesService->getByEmail($email);
        $this->assertIsArray($result);
    }
}
?>