<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinEnum
{
    public const PIG_LATIN_CONSONANT_SUFFIX = 'ay';
    public const PIG_LATIN_VOWEL_SUFFIX = 'yay';

    private const CONSONANTS = [
        'b', 'c', 'd', 'f',
        'g', 'h', 'j', 'k',
        'l', 'm', 'n', 'p',
        'q', 'r', 's', 't',
        'v', 'w', 'x', 'y',
        'z', 'B', 'C', 'D',
        'F', 'G', 'H', 'J',
        'K', 'L', 'M', 'N',
        'P', 'Q', 'R', 'S',
        'T', 'V', 'W', 'X',
        'Y', 'Z',
    ];

    private const VOWELS = [
        'a', 'e', 'i', 'o', 'u',
        'A', 'E', 'I', 'O', 'U',
    ];

    /** @return string[] */
    public static function getConsonants(): array
    {
        return self::CONSONANTS;
    }

    /** @return string[] */
    public static function getVowels(): array
    {
        return self::VOWELS;
    }
}
