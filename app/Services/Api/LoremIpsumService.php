<?php

namespace App\Services\Api;

use App\Interfaces\Services\LoremIpsumServiceInterface;
use App\Traits\LogsActivity;

class LoremIpsumService implements LoremIpsumServiceInterface
{
    use LogsActivity;

    private const LOREM_WORDS = [
        'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
        'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
        'magna', 'aliqua', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud',
        'exercitation', 'ullamco', 'laboris', 'nisi', 'aliquip', 'ex', 'ea', 'commodo',
        'consequat', 'duis', 'aute', 'irure', 'in', 'reprehenderit', 'voluptate',
        'velit', 'esse', 'cillum', 'fugiat', 'nulla', 'pariatur', 'excepteur', 'sint',
        'occaecat', 'cupidatat', 'non', 'proident', 'sunt', 'culpa', 'qui', 'officia',
        'deserunt', 'mollit', 'anim', 'id', 'est', 'laborum'
    ];

    public function generateLorem(array $validatedData): array
    {
        $type = $validatedData['type'] ?? 'paragraphs';
        $count = $validatedData['count'] ?? 3;
        $startWithLorem = $validatedData['start_with_lorem'] ?? true;

        $result = match($type) {
            'words' => $this->generateWords($count, $startWithLorem),
            'sentences' => $this->generateSentences($count, $startWithLorem),
            'paragraphs' => $this->generateParagraphs($count, $startWithLorem),
            default => $this->generateParagraphs($count, $startWithLorem)
        };

        $this->logInfo('Lorem Ipsum generated', [
            'type' => $type,
            'count' => $count,
            'start_with_lorem' => $startWithLorem,
            'text_length' => strlen($result['text'])
        ]);

        return $result;
    }

    private function generateWords(int $count, bool $startWithLorem): array
    {
        $words = [];
        
        if ($startWithLorem && $count >= 2) {
            $words[] = 'Lorem';
            $words[] = 'ipsum';
            $count -= 2;
        }

        for ($i = 0; $i < $count; $i++) {
            $words[] = $this->getRandomWord();
        }

        return [
            'text' => implode(' ', $words),
            'word_count' => count($words)
        ];
    }

    private function generateSentences(int $count, bool $startWithLorem): array
    {
        $sentences = [];
        
        for ($i = 0; $i < $count; $i++) {
            $sentenceLength = random_int(8, 15);
            $words = [];
            
            if ($i === 0 && $startWithLorem) {
                $words[] = 'Lorem';
                $words[] = 'ipsum';
                $sentenceLength -= 2;
            }

            for ($j = 0; $j < $sentenceLength; $j++) {
                $words[] = $this->getRandomWord();
            }

            $sentences[] = ucfirst(implode(' ', $words)) . '.';
        }

        return [
            'text' => implode(' ', $sentences),
            'sentence_count' => count($sentences),
            'word_count' => str_word_count(implode(' ', $sentences))
        ];
    }

    private function generateParagraphs(int $count, bool $startWithLorem): array
    {
        $paragraphs = [];
        
        for ($i = 0; $i < $count; $i++) {
            $sentenceCount = random_int(3, 6);
            $sentences = [];
            
            for ($j = 0; $j < $sentenceCount; $j++) {
                $sentenceLength = random_int(8, 15);
                $words = [];
                
                if ($i === 0 && $j === 0 && $startWithLorem) {
                    $words[] = 'Lorem';
                    $words[] = 'ipsum';
                    $sentenceLength -= 2;
                }

                for ($k = 0; $k < $sentenceLength; $k++) {
                    $words[] = $this->getRandomWord();
                }

                $sentences[] = ucfirst(implode(' ', $words)) . '.';
            }

            $paragraphs[] = implode(' ', $sentences);
        }

        return [
            'text' => implode("\n\n", $paragraphs),
            'paragraph_count' => count($paragraphs),
            'sentence_count' => array_sum(array_map(fn($p) => substr_count($p, '.'), $paragraphs)),
            'word_count' => str_word_count(implode("\n\n", $paragraphs))
        ];
    }

    private function getRandomWord(): string
    {
        return self::LOREM_WORDS[array_rand(self::LOREM_WORDS)];
    }
} 