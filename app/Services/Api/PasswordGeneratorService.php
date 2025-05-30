<?php

namespace App\Services\Api;

use App\DTO\PasswordGenerationData;
use App\Exceptions\ValidationException;
use App\Interfaces\Services\PasswordGeneratorServiceInterface;
use App\Traits\LogsActivity;

class PasswordGeneratorService implements PasswordGeneratorServiceInterface
{
    use LogsActivity;

    private const UPPERCASE_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private const LOWERCASE_CHARS = 'abcdefghijklmnopqrstuvwxyz';
    private const NUMBER_CHARS = '0123456789';
    private const SYMBOL_CHARS = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    public function generatePassword(array $validatedData): array
    {
        $passwordData = PasswordGenerationData::fromArray($validatedData);
        $this->validatePasswordConfiguration($passwordData);

        $password = $this->createPassword($passwordData);
        $passwordStrength = $this->calculatePasswordStrength($password);

        $this->logInfo('Password generated', [
            'length' => $passwordData->length,
            'options' => $passwordData->toArray(),
            'strength' => $passwordStrength['level']
        ]);

        return [
            'password' => $password,
            'length' => strlen($password),
            'strength' => $passwordStrength,
            'options' => $passwordData->toArray()
        ];
    }

    private function validatePasswordConfiguration(PasswordGenerationData $config): void
    {
        if (!$config->hasAtLeastOneOption()) {
            throw new ValidationException('Pelo menos um tipo de caractere deve ser selecionado');
        }
    }

    private function createPassword(PasswordGenerationData $config): string
    {
        $availableCharacters = $this->buildCharacterSet($config);
        $requiredCharacters = $this->getRequiredCharacters($config);
        
        $password = implode('', $requiredCharacters);
        $remainingLength = $config->length - count($requiredCharacters);

        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $this->getRandomCharacter($availableCharacters);
        }

        return str_shuffle($password);
    }

    private function buildCharacterSet(PasswordGenerationData $config): string
    {
        $characters = '';
        
        if ($config->uppercase) $characters .= self::UPPERCASE_CHARS;
        if ($config->lowercase) $characters .= self::LOWERCASE_CHARS;
        if ($config->numbers) $characters .= self::NUMBER_CHARS;
        if ($config->symbols) $characters .= self::SYMBOL_CHARS;

        return $characters;
    }

    private function getRequiredCharacters(PasswordGenerationData $config): array
    {
        $required = [];
        
        if ($config->uppercase) $required[] = $this->getRandomCharacter(self::UPPERCASE_CHARS);
        if ($config->lowercase) $required[] = $this->getRandomCharacter(self::LOWERCASE_CHARS);
        if ($config->numbers) $required[] = $this->getRandomCharacter(self::NUMBER_CHARS);
        if ($config->symbols) $required[] = $this->getRandomCharacter(self::SYMBOL_CHARS);

        return $required;
    }

    private function getRandomCharacter(string $characters): string
    {
        return $characters[random_int(0, strlen($characters) - 1)];
    }

    private function calculatePasswordStrength(string $password): array
    {
        $score = 0;
        $feedback = [];

        $score += $this->scorePasswordLength(strlen($password), $feedback);
        $score += $this->scoreCharacterTypes($password);

        $level = $this->determineStrengthLevel($score);

        return [
            'score' => $score,
            'level' => $level,
            'feedback' => $feedback
        ];
    }

    private function scorePasswordLength(int $length, array &$feedback): int
    {
        if ($length >= 12) {
            return 2;
        } elseif ($length >= 8) {
            return 1;
        } else {
            $feedback[] = 'Use pelo menos 8 caracteres';
            return 0;
        }
    }

    private function scoreCharacterTypes(string $password): int
    {
        $score = 0;
        
        if (preg_match('/[a-z]/', $password)) $score += 1;
        if (preg_match('/[A-Z]/', $password)) $score += 1;
        if (preg_match('/[0-9]/', $password)) $score += 1;
        if (preg_match('/[^a-zA-Z0-9]/', $password)) $score += 2;

        return $score;
    }

    private function determineStrengthLevel(int $score): string
    {
        return match(true) {
            $score >= 6 => 'forte',
            $score >= 4 => 'média',
            default => 'fraca'
        };
    }
} 