<?php

namespace App\DTOs;

class AttendanceDTO
{
    public int $employee_id;
    public ?string $clock_in;
    public ?string $clock_out;

    public function __construct(array $data)
    {
        $this->employee_id = $data['employee_id'];
        $this->clock_in = $data['clock_in'] ?? null;
        $this->clock_out = $data['clock_out'] ?? null;
    }
}
