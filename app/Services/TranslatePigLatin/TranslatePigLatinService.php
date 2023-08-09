<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinService
{

    private const WORD_END_PUNCTUATION = true;
    private const WORD_BEGINNING_PUNCTUATION = false;

    public function __construct(private TranslatePigLatinEnum $pigLatinEnum)
    {
    }

    public function translate(string $translationString): string
    {
        $splitInput = array_filter(preg_split('/[ \t\n]+/', $translationString));
        $pigLatinString = '';

        foreach ($splitInput as $word) {
            $pigLatinString .= $this->translateWord($word) . ' ';
        }

        return rtrim($pigLatinString);
    }

    private function translateWord(string $word): string
    {
        if (!preg_match('/[a-zA-Z]/', $word)) {
            return $word;
        }

        [$word, $punctuation, $end] = $this->extractPunctuation($word);

        $translatedWord = in_array($word[0], $this->pigLatinEnum::getVowels(), true)
            ? $this->translateVowelBeginning($word)
            : $this->translateConsonantBeginning($word);

        if ($punctuation !== null) {
            if ($end === true) {
                return $translatedWord . $punctuation;
            }
            return $punctuation . $translatedWord;
        }
        return $translatedWord;
    }

    /** @return mixed[] */
    private function extractPunctuation(string $word): array
    {
        $beginningPunctuation = preg_match('/^[[:punct:]]/', $word) === 1;
        $endPunctuation = preg_match('/[[:punct:]]$/', $word) === 1;

        if (!$beginningPunctuation && !$endPunctuation) {
            return [$word, null, null];
        }

        if ($endPunctuation) {
            $punctuation = substr($word, -1);
            $word = substr($word, 0, -1);
            $end = self::WORD_END_PUNCTUATION;
        } else {
            $punctuation = $word[0];
            $word = substr($word, 1);
            $end = self::WORD_BEGINNING_PUNCTUATION;
        }

        return [$word, $punctuation, $end];
    }

    private function translateConsonantBeginning(string $word): string
    {
        $consonantCluster = '';

        while (!empty($word) && in_array($word[0], $this->pigLatinEnum::getConsonants(), true)) {
            $char = $word[0];
            $consonantCluster .= $char;
            $word = substr($word, 1);
        }

        return $word . $consonantCluster . $this->pigLatinEnum::PIG_LATIN_CONSONANT_SUFFIX;
    }

    private function translateVowelBeginning(string $word): string
    {
        return $word . $this->pigLatinEnum::PIG_LATIN_VOWEL_SUFFIX;
    }
}
