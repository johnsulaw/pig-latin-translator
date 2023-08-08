<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinService
{

    public function __construct(private TranslatePigLatinEnum $pigLatinEnum)
    {
    }

    public function translate(string $translationString): string
    {
        return in_array($translationString[0], $this->pigLatinEnum::getVowels(), true) ? $this->translateVowelBeginning($translationString) : $this->translateConsonantBeginning($translationString);
    }

    private function translateConsonantBeginning(string $translationString): string
    {
        $consonantCluster = $rest = '';
        $translationStringLen = strlen($translationString);

        for ($i = 0; $i < $translationStringLen; $i++) {
            $char = $translationString[$i];

            if (in_array($char, $this->pigLatinEnum::getConsonants(), true)) {
                $consonantCluster .= $char;
                $rest = substr($translationString, $i+1);
            } else {
                break;
            }
        }

        return $rest . $consonantCluster . $this->pigLatinEnum::PIG_LATIN_SUFFIX;
    }

    private function translateVowelBeginning(string $translationString): string
    {
        return $translationString . $this->pigLatinEnum::PIG_LATIN_SUFFIX;
    }

}