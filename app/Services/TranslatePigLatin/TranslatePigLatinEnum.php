<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

/**
 * This class defines all the constants used in the
 * translation process.
 */
class TranslatePigLatinEnum
{
    public const CONSONANT_SUFFIX = 'ay';
    public const VOWEL_SUFFIX = 'yay';
    public const SEPARATOR = '-';
    public const QU_CONSONANT = 'qu';

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
