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
        $splitInput = array_filter(explode(' ', $translationString));
        $pigLatinString = '';

        foreach ($splitInput as $word) {
            if (!preg_match('/[a-zA-Z]/', $word)) {
                $pigLatinString .= $word . ' ';

                continue;
            }

            [$word, $punctuation, $end] = $this->extractPunctuation($word);

            $translatedWord = in_array($word[0], $this->pigLatinEnum::getVowels(), true)
                ? $this->translateVowelBeginning($word)
                : $this->translateConsonantBeginning($word);

            if ($punctuation !== null) {
                $pigLatinString .= $end === true
                    ? $translatedWord . $punctuation . ' '
                    : $punctuation . $translatedWord . ' ';

                continue;
            }

            $pigLatinString .= $translatedWord . ' ';
        }

        return rtrim($pigLatinString);
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
        $consonantCluster = $rest = '';
        $translationStringLen = strlen($word);

        for ($i = 0; $i < $translationStringLen; $i++) {
            $char = $word[$i];

            if (in_array($char, $this->pigLatinEnum::getConsonants(), true)) {
                $consonantCluster .= $char;
                $rest = substr($word, $i+1);
            } else {
                break;
            }
        }

        return $rest . $consonantCluster . $this->pigLatinEnum::PIG_LATIN_CONSONANT_SUFFIX;
    }

    private function translateVowelBeginning(string $word): string
    {
        return $word . $this->pigLatinEnum::PIG_LATIN_VOWEL_SUFFIX;
    }
}
