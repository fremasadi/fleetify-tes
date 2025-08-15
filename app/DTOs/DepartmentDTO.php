<?php

namespace App\DTOs;

class DepartmentDTO
{
    public string $departement_name;
    public ?string $max_clock_in_time;
    public ?string $max_clock_out_time;

    public function __construct(array $data)
    {
        $this->departement_name = $data['departement_name'];
        $this->max_clock_in_time = $data['max_clock_in_time'] ?? null;
        $this->max_clock_out_time = $data['max_clock_out_time'] ?? null;
    }
}
