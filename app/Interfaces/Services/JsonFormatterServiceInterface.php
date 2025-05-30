<?php

namespace App\Interfaces\Services;

interface JsonFormatterServiceInterface
{
    /**
     * Processa JSON com diferentes ações (format, minify, validate)
     *
     * @param array $validatedData
     * @return array
     * @throws \InvalidArgumentException
     */
    public function processJson(array $validatedData): array;
} 