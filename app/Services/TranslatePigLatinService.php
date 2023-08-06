<?php declare(strict_types=1);

namespace App\Services;

class TranslatePigLatinService
{

    private array $consonants = [
        'b', 'c', 'd', 'f',
        'g', 'h', 'j', 'k',
        'l', 'm', 'n', 'p',
        'q', 'r', 's', 't',
        'v', 'w', 'x', 'y',
        'z',
    ];

    private array $vowels = [
      'a', 'e', 'i', 'o', 'u',
    ];

    public function __construct(){

    }

    public function translate(string $translationString): string
    {
        $consonantCluster = $rest = '';
        $translationStringLen = strlen($translationString);

        for ($i = 0; $i < $translationStringLen; $i++) {
            $char = $translationString[$i];

            if (in_array($char, $this->consonants, true)) {
                $consonantCluster .= $char;
                $rest = substr($translationString, $i+1);
            } else {
                break;
            }
        }

        return $rest . $consonantCluster . 'ay';
    }

}