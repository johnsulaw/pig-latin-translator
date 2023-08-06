<?php declare(strict_types=1);

namespace App\Services;

class TranslatePigLatinService
{

    public function __construct(){

    }

    public function translate(string $translationString): string
    {
        $newString = $translationString . 'foo';

        return $newString;
    }

}