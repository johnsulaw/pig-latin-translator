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

    public function testTranslateWord()
    {
        $englishWord = 'beast';
        $expectedPigLatinWord = 'eastbay';

        $result = $this->translatePigLatinService->translate($englishWord);
        $this->assertEquals($expectedPigLatinWord, $result);
    }

    //public function testTranslateSentence()
    //{
    //}
}
