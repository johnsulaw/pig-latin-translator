<?php declare(strict_types=1);

namespace App\Services\TranslatePigLatin;

class TranslatePigLatinPunctuationHandler
{

    private string $beginningPunctuation = '';

    private string $endPunctuation = '';

    private string $word;

    public function __construct()
    {
    }

    public function handlePunctuation(string $word): void
    {
        $beginningPunctuationMatches = $endPunctuationMatches = [];

        $beginningPunctuation = preg_match('/^[[:punct:]]+/', $word, $beginningPunctuationMatches) === 1;
        $endPunctuation = preg_match('/[[:punct:]]+$/', $word, $endPunctuationMatches) === 1;

        $this->beginningPunctuation = $beginningPunctuation ? $beginningPunctuationMatches[0] : '';
        $this->endPunctuation = $endPunctuation ? $endPunctuationMatches[0] : '';

        $this->word = preg_replace('/^[[:punct:]]+/', '', $word);
        $this->word = preg_replace('/[[:punct:]]+$/', '', $this->word);
    }

    public function hasBeginningPunctuation(): bool
    {
        return $this->beginningPunctuation !== '';
    }

    public function hasEndPunctuation(): bool
    {
        return $this->endPunctuation !== '';
    }

    public function hasPunctuation(): bool
    {
        return $this->hasEndPunctuation() || $this->hasBeginningPunctuation();
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getBeginningPunctuation(): string
    {
        return $this->beginningPunctuation;
    }

    public function getEndPunctuation(): string
    {
        return $this->endPunctuation;
    }
}