<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinEnum
{
    public const PIG_LATIN_SUFFIX = 'ay';

    private const CONSONANTS = [
        'b', 'c', 'd', 'f',
        'g', 'h', 'j', 'k',
        'l', 'm', 'n', 'p',
        'q', 'r', 's', 't',
        'v', 'w', 'x', 'y',
        'z',
    ];

    private const VOWELS = [
        'a', 'e', 'i', 'o', 'u',
    ];

    public static function getConsonants(): array
    {
        return self::CONSONANTS;
    }

    public static function getVowels(): array
    {
        return self::VOWELS;
    }
}
