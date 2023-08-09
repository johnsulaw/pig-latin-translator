<?php declare(strict_types=1);

namespace TranslatePigLatin;

use App\Services\TranslatePigLatin\TranslatePigLatinEnum;
use App\Services\TranslatePigLatin\TranslatePigLatinService;
use PHPUnit\Framework\TestCase;

class PigLatinTranslatorTest extends TestCase
{

    private TranslatePigLatinService $translatePigLatinService;

    public function __construct()
    {
        parent::__construct();

        $pigLatinEnum = new TranslatePigLatinEnum();
        $this->translatePigLatinService = new TranslatePigLatinService($pigLatinEnum);
    }

    public function testTranslateConsonantWord(): void
    {
        $word = 'beast';
        $expectedResult = 'eastbay';

        $result = $this->translatePigLatinService->translate($word);
        $this->assertEquals($expectedResult, $result);
    }

    public function testTranslateVowelWord(): void
    {
        $word = 'eagle';
        $expectedResult = 'eagleay';

        $result = $this->translatePigLatinService->translate($word);
        $this->assertEquals($expectedResult, $result);
    }

    //public function translateSimpleSentence(): void
    //{
    //    $sentence = 'Quick brown fox jumps over the lazy dog.';
    //}

    public function testTranslateNumber(): void
    {
        $number = '42';

        $result = $this->translatePigLatinService->translate($number);
        $this->assertEquals($number, $result);
    }

    public function testWhitespaceCharacters(): void
    {
        $whitespaceCharacters = [' ', "\t", PHP_EOL];
        $result = [];

        foreach ($whitespaceCharacters as $character) {
            $result[] = $this->translatePigLatinService->translate($character);
        }

        $this->assertEquals($whitespaceCharacters, $result);
    }

    //public function testTranslateSentence()
    //{
    //}
}
