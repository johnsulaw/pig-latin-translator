<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinService
{

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

            $punctuation = null;

            if (preg_match('/[.,!?;:]$/', $word) === 1) {
                [$word, $punctuation] = $this->handlePunctuation($word);
            }

            $pigLatinString .= in_array($word[0], $this->pigLatinEnum::getVowels(), true)
                ? $this->translateVowelBeginning($word)
                : $this->translateConsonantBeginning($word);

            $pigLatinString .= $punctuation. ' ' ?? ' ';
        }

        return rtrim($pigLatinString);
    }

    /** @return string[] */
    private function handlePunctuation(string $word): array
    {
        $punctuation = substr($word, -1);
        $word = substr($word, 0, -1);

        return [$word, $punctuation];
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
