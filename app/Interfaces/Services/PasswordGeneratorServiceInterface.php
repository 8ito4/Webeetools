<?php

namespace App\Interfaces\Services;

interface PasswordGeneratorServiceInterface
{
    /**
     * Gera uma senha segura baseada nas configurações fornecidas
     *
     * @param array $validatedData
     * @return array
     * @throws \InvalidArgumentException
     */
    public function generatePassword(array $validatedData): array;
} 