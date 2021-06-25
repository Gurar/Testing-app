<?php
namespace Controller;
use Repository\EmployeeRepository;

class EmployeeController {
    private $employeeRepository; 
    public function __construct(EmployeeRepository $er){
        $this->employeeRepository = $er;
    }
    public function getAll(){}
    public function getAllById(){}
    public function getAllJson() : string {
        return json_encode($this->employeeRepository->getAll());
    }

    public function getAllJsonWithMetaInformation() :string {
        $arr = $this->employeeRepository->getAll();
        $arr['count'] = count($arr);
        $json = json_encode(array_values($arr));
        return $json;
    }
}
