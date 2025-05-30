<?php

namespace App\Repositories;

use App\Services\Tools\CellphoneGeneratorService;

class CellphoneGeneratorRepository
{
    public function __construct(
        private CellphoneGeneratorService $service
    ) {}

    public function generate($ddd = null): string
    {
        return $this->service->generate($ddd);
    }
} 