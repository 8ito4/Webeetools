<?php

namespace App\Enums;

enum JsonAction: string
{
    case FORMAT = 'format';
    case MINIFY = 'minify';
    case VALIDATE = 'validate';

    public function getDescription(): string
    {
        return match($this) {
            self::FORMAT => 'Formatar JSON com indentação',
            self::MINIFY => 'Minificar JSON removendo espaços',
            self::VALIDATE => 'Validar estrutura do JSON'
        };
    }

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
} 