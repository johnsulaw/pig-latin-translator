<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinService
{

    public function __construct(private TranslatePigLatinEnum $pigLatinEnum, private TranslatePigLatinPunctuationHandler $punctuationHandler)
    {
    }

    public function translate(string $translationString, bool $useHyphen = false): string
    {
        $splitInput = array_filter(preg_split('/[ \t\n]+/', $translationString));
        $pigLatinString = '';

        foreach ($splitInput as $word) {
            $pigLatinString .= $this->translateWord($word, $useHyphen) . ' ';
        }

        return rtrim($pigLatinString);
    }

    private function translateWord(string $word, bool $useHyphen): string
    {
        if (!preg_match('/[a-zA-Z]/', $word)) {
            return $word;
        }

        $this->punctuationHandler->handlePunctuation($word);
        $word = $this->punctuationHandler->getWord();

        $translatedWord = in_array($word[0], $this->pigLatinEnum::getVowels(), true)
            ? $this->translateVowelBeginning($word, $useHyphen)
            : $this->translateConsonantBeginning($word, $useHyphen);

        return $this->reassembleWord($translatedWord);
    }

    private function reassembleWord(string $translatedWord): string
    {
        if ($this->punctuationHandler->hasPunctuation()) {
            if ($this->punctuationHandler->hasEndPunctuation() && $this->punctuationHandler->hasBeginningPunctuation()) {
                return $this->punctuationHandler->getBeginningPunctuation() . $translatedWord . $this->punctuationHandler->getEndPunctuation();
            }
            if ($this->punctuationHandler->hasEndPunctuation()) {
                return $translatedWord . $this->punctuationHandler->getEndPunctuation();
            }
            return $this->punctuationHandler->getBeginningPunctuation() . $translatedWord;
        }
        return $translatedWord;
    }

    private function translateConsonantBeginning(string $word, bool $useHyphen): string
    {
        $consonantCluster = '';

        while (!empty($word) && in_array($word[0], $this->pigLatinEnum::getConsonants(), true)) {
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

        return $useHyphen === true
            ? $word . $this->pigLatinEnum::SEPARATOR . $consonantCluster . $this->pigLatinEnum::CONSONANT_SUFFIX
            : $word . $consonantCluster . $this->pigLatinEnum::CONSONANT_SUFFIX;
    }

    private function translateVowelBeginning(string $word, bool $useHyphen): string
    {
        return $useHyphen === true
            ? $word . $this->pigLatinEnum::SEPARATOR . $this->pigLatinEnum::VOWEL_SUFFIX
            : $word . $this->pigLatinEnum::VOWEL_SUFFIX;
    }
}
