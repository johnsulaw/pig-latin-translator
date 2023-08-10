<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinService
{

    private bool $useSeparator;

    public function __construct(private TranslatePigLatinPunctuationHandler $punctuationHandler)
    {
    }

    public function translate(string $translationString, bool $useSeparator = false): string
    {
        $this->useSeparator = $useSeparator;

        $splitInput = preg_split('/[ \t\n]+/', $translationString);

        if ($splitInput === false) {
            return 'An error occurred. Please try again.';
        }

        $filteredInput = array_filter($splitInput);
        $pigLatinString = '';

        foreach ($filteredInput as $word) {
            $pigLatinString .= $this->translateWord($word) . ' ';
        }

        return rtrim($pigLatinString);
    }

    private function translateWord(string $word): string
    {
        if (!preg_match('/[a-zA-Z]/', $word)) {
            return $word;
        }

        $word = $this->punctuationHandler->disassembleWord($word);

        $translatedWord = in_array($word[0], TranslatePigLatinEnum::getVowels(), true)
            ? $this->translateVowelBeginning($word)
            : $this->translateConsonantBeginning($word);

        return $this->punctuationHandler->reassembleWord($translatedWord);
    }

    private function translateConsonantBeginning(string $word): string
    {
        $consonantCluster = '';

        while (!empty($word) && in_array($word[0], TranslatePigLatinEnum::getConsonants(), true)) {
            $char = $word[0];
            $consonantCluster .= $char;
            $word = substr($word, 1);
        }

        /* Even though 'u' is a vowel, in English
        the pair 'qu' is considered a consonant cluster */
        if ($consonantCluster === 'q' && $word[0] === 'u') {
            $consonantCluster .= $word[0];
            $word = substr($word, 1);
        }

        return $this->useSeparator === true
            ? $word . TranslatePigLatinEnum::SEPARATOR . $consonantCluster . TranslatePigLatinEnum::CONSONANT_SUFFIX
            : $word . $consonantCluster . TranslatePigLatinEnum::CONSONANT_SUFFIX;
    }

    private function translateVowelBeginning(string $word): string
    {
        return $this->useSeparator === true
            ? $word . TranslatePigLatinEnum::SEPARATOR . TranslatePigLatinEnum::VOWEL_SUFFIX
            : $word . TranslatePigLatinEnum::VOWEL_SUFFIX;
    }
}
