<?php

namespace App\DTOs;

class EmployeeDTO
{
    public function __construct(
        public int $employee_id,
        public int $departement_id,
        public ?string $address
    ) {}
}
