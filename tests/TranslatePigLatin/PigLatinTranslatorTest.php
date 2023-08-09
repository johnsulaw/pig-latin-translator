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
        $expectedResult = 'eagleyay';

        $result = $this->translatePigLatinService->translate($word);
        $this->assertEquals($expectedResult, $result);
    }

    public function testTranslateSimpleSentence(): void
    {
        $sentence = 'Quick brown fox jumps over the lazy dog.';
        $expectedResult = 'uickQay ownbray oxfay umpsjay overyay ethay azylay ogday.';

        $result = $this->translatePigLatinService->translate($sentence);
        $this->assertEquals($expectedResult, $result);
    }

    public function testTranslateMultipleSentences(): void
    {
        $sentence = 'His house is very beautiful. That one, over there? Yes, that one!';
        $expectedResult = 'isHay ousehay isyay eryvay eautifulbay. atThay oneyay, overyay erethay? esYay, atthay oneyay!';

        $result = $this->translatePigLatinService->translate($sentence);
        $this->assertEquals($expectedResult, $result);
    }

    public function testTranslateNonAlphabeticalString(): void
    {
        $nonAlphaStrings = ['42', '!', '?!', ';', '#', '-'];

        foreach ($nonAlphaStrings as $string) {
            $result = $this->translatePigLatinService->translate($string);
            $this->assertEquals($string, $result);
        }
    }

    public function testWhitespaceCharacters(): void
    {
        $whitespaceCharacters = [' ', "\t", PHP_EOL];

        foreach ($whitespaceCharacters as $character) {
            $result = $this->translatePigLatinService->translate($character);
            $this->assertEquals('', $result);
        }
    }
}
