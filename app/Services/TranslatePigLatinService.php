<?php declare(strict_types=1);

namespace App\Services;

class TranslatePigLatinService
{

    private const PIG_LATIN_SUFFIX = 'ay';

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

    public function __construct(){

    }

    public function translate(string $translationString): string
    {
        return in_array($translationString[0], self::VOWELS, true) ? $this->translateVowelBeginning($translationString) : $this->translateConsonantBeginning($translationString);
    }

    public function translateConsonantBeginning(string $translationString): string
    {
        $consonantCluster = $rest = '';
        $translationStringLen = strlen($translationString);

        for ($i = 0; $i < $translationStringLen; $i++) {
            $char = $translationString[$i];

            if (in_array($char, self::CONSONANTS, true)) {
                $consonantCluster .= $char;
                $rest = substr($translationString, $i+1);
            } else {
                break;
            }
        }

        return $rest . $consonantCluster . self::PIG_LATIN_SUFFIX;
    }

    public function translateVowelBeginning(string $translationString): string
    {
        return $translationString . self::PIG_LATIN_SUFFIX;
    }

}