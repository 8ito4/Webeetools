<?php

namespace App\Repositories;

use App\Services\CellphoneGeneratorService;

class CellphoneGeneratorRepository
{
    protected $service;

    public function __construct(CellphoneGeneratorService $service)
    {
        $this->service = $service;
    }

    public function generate($ddd = null)
    {
        return $this->service->generate($ddd);
    }
} 