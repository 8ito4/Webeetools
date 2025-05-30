<?php

namespace App\Interfaces\Services;

interface LoremIpsumServiceInterface
{
    /**
     * Gera texto Lorem Ipsum baseado nas configurações
     *
     * @param array $validatedData
     * @return array
     */
    public function generateLorem(array $validatedData): array;
} 