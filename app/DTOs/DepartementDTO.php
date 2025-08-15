<?php

namespace App\DTOs;

class DepartementDTO
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

    public function toArray(): array
    {
        return [
            'departement_name' => $this->departement_name,
            'max_clock_in_time' => $this->max_clock_in_time,
            'max_clock_out_time' => $this->max_clock_out_time,
        ];
    }
}
