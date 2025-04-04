<?php
require_once 'UserDao.php';
require_once 'EmployeesDao.php';
require_once 'OrdersDao.php';
require_once 'ServicesDao.php';
require_once 'OrderServicesDao.php';

// Initialize all DAOs
$userDao = new UserDao();
$employeeDao = new EmployeesDao();
$orderDao = new OrderDao();
$serviceDao = new ServicesDao();
$orderServiceDao = new OrderServicesDao();

try {
    // Test User operations
    echo "\n=== Testing User Operations ===\n";
    $userId = $userDao->insert([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT)
    ]);
    echo "Inserted new user\n";

    $users = $userDao->getAll();
    echo "All users: " . print_r($users, true) . "\n";

    $userByEmail = $userDao->getByEmail('john@example.com');
    echo "User by email: " . print_r($userByEmail, true) . "\n";

    // Test Employee operations
    echo "\n=== Testing Employee Operations ===\n";
    $employeeId = $employeeDao->insert([
        'name' => 'Jane Smith',
        'email' => 'jane@company.com',
        'password' => password_hash('emp123', PASSWORD_DEFAULT)
    ]);
    echo "Inserted new employee\n";

    $employeeByEmail = $employeeDao->getByEmail('jane@company.com');
    echo "Employee by email: " . print_r($employeeByEmail, true) . "\n";

    // Test Service operations
    echo "\n=== Testing Service Operations ===\n";
    $serviceData = [
        'service_name' => 'Basic Cleaning',
        'description' => 'Standard cleaning service',
        'price' => 99.99
    ];
    $serviceDao->addServices($serviceData);
    echo "Added new service\n";

    $serviceUpdateData = [
        'service_name' => 'Premium Cleaning',
        'price' => 149.99
    ];
    $serviceDao->updateService(1, $serviceUpdateData);
    echo "Updated service\n";

    $service = $serviceDao->getAllServices(1);
    echo "Service details: " . print_r($service, true) . "\n";

    // Test Order operations
    echo "\n=== Testing Order Operations ===\n";
    $orderData = [
        'customer_id' => $userId,
        'employee_id' => $employeeId,
        'status' => 'pending',
        'total_price' => 100
    ];
    $orderDao->addOrder($orderData);
    echo "Added new order\n";

    $userOrders = $orderDao->getByUserId($userId);
    echo "Orders for user: " . print_r($userOrders, true) . "\n";

    $orderUpdateData = [
        'status' => 'completed',
        'total_price' => 249.99
    ];
    $orderDao->updateOrder(1, $orderUpdateData);
    echo "Updated order\n";

    // Test OrderService operations
    echo "\n=== Testing OrderService Operations ===\n";
    $orderServiceData = [
        'order_id' => 1,
        'service_id' => 1
    ];

    $orderServiceDao->insert($orderServiceData);
    echo "Added new order service\n";

    $orderServices = $orderServiceDao->getAllOrderServices(1);
    echo "Order services: " . print_r($orderServices, true) . "\n";

    // Test deletion operations
    echo "\n=== Testing Delete Operations ===\n";
    $orderDao->deleteOrder(1);
    echo "Deleted order\n";

    $serviceDao->deleteService(1);
    echo "Deleted service\n";

    $userDao->delete($userId);
    echo "Deleted user\n";

    $employeeDao->delete($employeeId);
    echo "Deleted employee\n";

    echo "\nAll tests completed successfully!\n";

} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage() . "\n";
}
?>