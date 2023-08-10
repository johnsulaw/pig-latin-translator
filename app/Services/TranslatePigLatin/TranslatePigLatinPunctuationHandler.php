<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

/**
 * This class handles punctuation in the input word by
 * splitting the string into three parts - end and beginning
 * punctuation and the word itself.
 */
class TranslatePigLatinPunctuationHandler
{

    private string $beginningPunctuation = '';

    private string $endPunctuation = '';

    public function __construct()
    {
    }

    /**
     * This function splits the word with punctuation into the
     * three different parts and stores relevant data.
     *
     * @return string Word with removed punctuation
     */
    public function disassembleWord(string $punctuatedWord): string
    {
        $beginningPunctuationMatches = $endPunctuationMatches = [];

        $beginningPunctuation = preg_match('/^[[:punct:]]+/', $punctuatedWord, $beginningPunctuationMatches) === 1;
        $endPunctuation = preg_match('/[[:punct:]]+$/', $punctuatedWord, $endPunctuationMatches) === 1;

        $this->beginningPunctuation = $beginningPunctuation ? $beginningPunctuationMatches[0] : '';
        $this->endPunctuation = $endPunctuation ? $endPunctuationMatches[0] : '';

        return preg_replace('/^[[:punct:]]+|[[:punct:]]+$/', '', $punctuatedWord);
    }

    /**
     * This function puts back together the translated word with
     * saved punctuation at the correct places.
     *
     * @return string Translated word with punctuation
     */
    public function reassembleWord(string $translatedWord): string
    {
        if ($this->hasPunctuation()) {
            if ($this->hasEndPunctuation()
                && $this->hasBeginningPunctuation()
            ) {
                return $this->getBeginningPunctuation()
                    . $translatedWord
                    . $this->getEndPunctuation();
            }
            if ($this->hasEndPunctuation()) {
                return $translatedWord . $this->getEndPunctuation();
            }
            return $this->getBeginningPunctuation() . $translatedWord;
        }
        return $translatedWord;
    }

    private function hasBeginningPunctuation(): bool
    {
        return $this->beginningPunctuation !== '';
    }

    private function hasEndPunctuation(): bool
    {
        return $this->endPunctuation !== '';
    }

    private function hasPunctuation(): bool
    {
        return $this->hasEndPunctuation() || $this->hasBeginningPunctuation();
    }

    private function getBeginningPunctuation(): string
    {
        return $this->beginningPunctuation;
    }

    private function getEndPunctuation(): string
    {
        return $this->endPunctuation;
    }
}
