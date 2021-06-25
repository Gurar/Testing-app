<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use Controller\EmployeeController;
use Repository\EmployeeRepository;
use Model\Employee;
use Faker\Factory;

class EmployeeControllerTest extends TestCase {
    private $employeeController;
    private $mock;
    private $faker;

    
    protected function setUp() :void {
        $this->faker = Factory::create();
        $this->mock = $this->getMockBuilder(EmployeeRepository::class)->getMock();
        $this->employeeController = new EmployeeController($this->mock);
    }

    public function testGetAllJsonReturnsJson() :void {
        $employees = [];

        for($i = 0; $i < 2; $i++) {
            array_push($employees, new Employee($i, $this->faker->name()));
        }

        $this->mock->expects($this->exactly(1))
            ->method('getAll')
            ->willReturn($employees);

        $employees['count'] = count($employees);
        $employees = (array_values($employees));
  
        $res = $this->employeeController->getAllJsonWithMetaInformation();

        assertEquals(json_encode($employees), $res);
    }

}